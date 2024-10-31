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

namespace PGI\Impact\PGWooCharity\Services\Listeners;

use Exception;
use PGI\Impact\PGCharity\Interfaces\Entities\GiftEntityInterface;
use PGI\Impact\PGCharity\Services\Handlers\CharityHandler;
use PGI\Impact\PGCharity\Services\Repositories\GiftRepository;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Components\Events\LocalOrder as LocalOrderEventComponent;
use PGI\Impact\PGShop\Interfaces\Entities\OrderEntityInterface;

/**
 * CharityGiftFinalizationListener
 * @package PGWooCharity\Services\Listeners
 */
class CharityGiftFinalizationListener
{
    /** @var CharityHandler */
    private $charityHandler;

    /** @var GiftRepository */
    private $giftRepository;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        CharityHandler $charityHandler,
        GiftRepository $giftRepository,
        LoggerInterface $logger
    ) {
        $this->charityHandler = $charityHandler;
        $this->giftRepository = $giftRepository;
        $this->logger = $logger;
    }

    /**
     * @params LocalOrderEventComponent $event
     * @throws Exception
     */
    public function listen(LocalOrderEventComponent $event)
    {
        try {
            /** @var OrderEntityInterface $order */
            $order = $event->getOrder();

            if ($order === null) {
                throw new Exception("Order is required to finalize charity gift.");
            } elseif (!$order instanceof OrderEntityInterface) {
                throw new Exception("Order must be an instance of OrderEntityInterface.");
            }

            $giftReference = $this->charityHandler->getGiftItemData($order);

            /** @var GiftEntityInterface $giftEntity */
            $giftEntity = $this->giftRepository->findByReferencePrimary($giftReference);

            if ($giftEntity !== null && $giftEntity->getStatus() !== "SUCCESS") {

                if($this->charityHandler->finalizeGift($order, $giftEntity->getPartnershipId(),$giftReference)) {
                    $giftEntity->setStatus("SUCCESS");
                    $this->logger->debug("Donation successfully created.");
                } else {
                    $giftEntity->setStatus("FAILED");
                    $this->logger->debug("Donation creation failed.");
                }

                $this->giftRepository->update($giftEntity);
            }

        } catch (Exception $exception) {
            $text = "An error occurred while finalizing the charity gift : " . $exception->getMessage();
            $this->logger->error($text, $exception);
        }
    }
}
