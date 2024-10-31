<?php
/**
 * 2014 - 2023 Watt Is It
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License X11
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/mit-license.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@paygreen.fr so we can send you a copy immediately.
 *
 * @author    PayGreen <contact@paygreen.fr>
 * @copyright 2014 - 2023 Watt Is It
 * @license   https://opensource.org/licenses/mit-license.php MIT License X11
 * @version   1.3.7
 *
 */

namespace PGI\Impact\PGCharity\Services\Handlers;

use DateTime;
use Exception;
use PGI\Impact\APICharity\Services\Facades\ApiFacade;
use PGI\Impact\PGCharity\Services\Managers\GiftManager;
use PGI\Impact\PGClient\Exceptions\Response as ResponseException;
use PGI\Impact\PGFramework\Services\Handlers\SessionHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGShop\Interfaces\Entities\AddressEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CustomerEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\OrderEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopableItemEntityInterface;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;
use PGI\Impact\PGShop\Tools\Price as PriceTool;
use stdClass;

/**
 * Class CharityHandler
 * @package PGCharity\Services\Handlers
 */
class CharityHandler
{
    const CHARITY_ASSOCIATION_ID_SESSION_NAME = 'paygreen_charity_association_id';

    /** @var CharityCartHandler */
    private $charityCartHandler;

    /** @var CharityPartnershipHandler */
    private $charityPartnershipHandler;

    /** @var CharityGiftHandler */
    private $charityGiftHandler;

    /** @var ApiFacade */
    private $charityApiFacade;

    /** @var SessionHandler */
    private $sessionHandler;

    /** @var GiftManager */
    private $giftManager;

    /** @var ShopHandler */
    private $shopHandler;

    /** @var Settings */
    private $settings;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        CharityCartHandler $charityCartHandler,
        CharityPartnershipHandler $charityPartnershipHandler,
        CharityGiftHandler $charityGiftHandler,
        ApiFacade $charityApiFacade,
        SessionHandler $sessionHandler,
        GiftManager $giftManager,
        ShopHandler $shopHandler,
        Settings $settings,
        LoggerInterface $logger
    ) {
        $this->charityCartHandler = $charityCartHandler;
        $this->charityPartnershipHandler = $charityPartnershipHandler;
        $this->charityGiftHandler = $charityGiftHandler;
        $this->charityApiFacade = $charityApiFacade;
        $this->sessionHandler = $sessionHandler;
        $this->giftManager = $giftManager;
        $this->shopHandler = $shopHandler;
        $this->settings = $settings;
        $this->logger = $logger;
    }

    /**
     * @return int
     * @throws ResponseException
     * @throws Exception
     */
    public function getCurrentPartnershipPrimary()
    {
        if ($this->sessionHandler->has(self::CHARITY_ASSOCIATION_ID_SESSION_NAME)) {
            $currentPartnershipPrimary = $this->sessionHandler->get(self::CHARITY_ASSOCIATION_ID_SESSION_NAME);
        } else {
            $partnerships = $this->charityPartnershipHandler->getPartnerships();

            if (empty($partnerships)) {
                throw new Exception('No partnership has been found.');
            }

            $currentPartnershipPrimary = $partnerships[0]->association->idAssociation;
        }

        return $currentPartnershipPrimary;
    }

    /**
     * @return bool
     */
    public function hasGift()
    {
        return $this->charityCartHandler->hasGift();
    }

    /**
     * @return ShopableItemEntityInterface
     */
    public function getGift()
    {
        return $this->charityCartHandler->getGift();
    }

    /**
     * @param int $amount
     * @param string $cartId
     * @param int $giftAssociationId
     * @return bool
     * @throws Exception
     */
    public function addGift($amount, $cartId, $giftAssociationId)
    {
        $result = false;
        $giftReference = $this->generateUniqueGiftReference();
        if ($this->charityCartHandler->addGift($amount,$giftReference)) {

            if (!$this->saveDonation($giftReference, $cartId, $giftAssociationId, $amount*100)) {
                throw new Exception(
                    "An error occured during donation saving."
                );
            }

            $giftAmount = PriceTool::toFloat($amount);
            $result = true;
            $this->logger->info("Successed donation with an amount of '$giftAmount' successfully created.");
        }

        return $result;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function removeGift()
    {
        return $this->charityCartHandler->removeGift();
    }

    /**
     * @return float
     */
    public function getCurrentAmount()
    {
        $amount = ($this->hasGift()) ? $this->getGift()->getCost() : $this->getDefaultAmount();

        return PriceTool::toFloat($amount);
    }

    /**
     * @return float|int
     */
    public function getDefaultAmount()
    {
        return $this->getRoundUp($this->charityCartHandler->getCartTotalAmount());
    }


    /**
     * @param OrderEntityInterface $order
     * @return string
     * @throws Exception
     */
    public function getGiftItemData($order)
    {
        $result = "";
        $giftId = $this->charityGiftHandler->getPrimary();

        /** @var ShopableItemEntityInterface $item */
        foreach ($order->getItems() as $item) {
            if ($item->getProduct()->id() === $giftId) {
                $result = $item->getProductDescription();
            }
        }

        return $result;
    }

    /**
     * @param OrderEntityInterface $order
     * @return bool
     * @throws Exception
     */
    public function finalizeGift(OrderEntityInterface $order, $partnershipId, $reference)
    {
        $result = false;
        $giftId = $this->charityGiftHandler->getPrimary();
        $giftAmount = 0;


        /** @var ShopableItemEntityInterface $item */
        foreach ($order->getItems() as $item) {
            if ($item->getProduct()->id() === $giftId) {
                $giftAmount += $item->getCost();
            }
        }

        if ($giftAmount > 0 && $partnershipId > 0) {
            $buyer = $this->buildBuyer($order);
            $currency = ($order->getCurrency() !== null) ? $order->getCurrency() : 'EUR';

            $response = $this->charityApiFacade->createDonation(
                $partnershipId,
                'ROUNDING',
                $giftAmount,
                $order->getTotalAmount(),
                $currency,
                $buyer,
                false,
                $reference
            );

            if ($response->getHTTPCode() === 201) {
                $giftAmount = PriceTool::toFloat($giftAmount);
                $this->logger->info("Successed donation with an amount of '$giftAmount' $currency successfully created.");
                $result = true;
            }

        }

        return $result;
    }

    /**
     * @param string $reference
     * @param string $cartId
     * @param int $id_partnership
     * @param int $amount
     * @return bool
     */
    protected function saveDonation($reference, $cartId, $id_partnership, $amount)
    {
        $giftEntity = $this->giftManager->getByCartPrimary($cartId);

        if ($giftEntity === null) {
            $giftEntity = $this->giftManager->create(
                $reference,
                $cartId,
                $id_partnership,
                $amount
            );
        } else {
            $giftEntity->setAmount($amount);
            $giftEntity->setPartnershipId($id_partnership);
            $giftEntity->setReference($reference);
        }

        return $this->giftManager->save($giftEntity);
    }

    /**
     * @param OrderEntityInterface $order
     * @return stdClass
     * @throws Exception
     */
    protected function buildBuyer(OrderEntityInterface $order)
    {
        $buyer = new stdClass();

        /** @var CustomerEntityInterface $customer */
        $customer = $order->getCustomer();

        if ($customer === null) {
            throw new Exception('Customer not found.');
        }

        $buyer->lastname = $customer->getLastname();
        $buyer->lastname = $customer->getFirstname();
        $buyer->email = $customer->getEmail();

        /** @var AddressEntityInterface|null $billingAddress */
        $billingAddress = $customer->getBillingAddress();

        if ($billingAddress !== null) {
            $buyer->address = $billingAddress->getAddressLineOne();
            $buyer->address2 = $billingAddress->getAddressLineTwo();
            $buyer->zipcode = $billingAddress->getZipCode();
            $buyer->city = $billingAddress->getCity();
        }

        return $buyer;
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function generateUniqueGiftReference()
    {
        $shopId = $this->shopHandler->getCurrentShopPrimary();
        $clientId = $this->settings->get('charity_client_id');
        $giftReferenceToHash = $this->getTimestampAsAString() . $shopId . $clientId . mt_rand(0, PHP_INT_MAX);

        return 'GIFT-' . hash('sha256', $giftReferenceToHash);
    }

    /**
     * @param int $amount
     * @return int
     */
    protected function getRoundUp($amount)
    {
        $amount = ($amount / 100);

        if (is_float($amount)) {
            $inferiorInt = floor($amount);
            $superiorInt = ($inferiorInt + 1);
            $amount = (($superiorInt - $amount) * 100);
        } else {
            $amount = 100;
        }

        return $amount;
    }

    /**
     * @throws Exception
     * @return string
     */
    private function getTimestampAsAString()
    {
        $datetime = new DateTime();
        return (string) $datetime->getTimestamp();
    }
}
