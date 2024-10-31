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

namespace PGI\Impact\PGTree\Services\Handlers;

use Exception;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopableItemEntityInterface;
use PGI\Impact\PGShop\Services\Managers\CartManager;
use PGI\Impact\PGShop\Services\Managers\ProductManager;

/**
 * Class TreeCartHandler
 * @package PGTree\Services\Handlers
 */
class TreeCartHandler
{
    /** @var CartManager */
    private $cartManager;

    /** @var TreeContributionHandler */
    private $treeContributionHandler;

    /** @var ProductManager */
    private $productManager;

    /** @var LoggerInterface */
    private $logger;

    /** @var int|null */
    private $contributionProductPrimary = null;

    public function __construct(
        CartManager $cartManager,
        TreeContributionHandler $treeContributionHandler,
        ProductManager $productManager,
        LoggerInterface $logger
    ) {
        $this->cartManager = $cartManager;
        $this->treeContributionHandler = $treeContributionHandler;
        $this->productManager = $productManager;
        $this->logger = $logger;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function hasContribution()
    {
        $cart = $this->cartManager->getCurrent();

        /** @var ShopableItemEntityInterface $item */
        foreach ($cart->getItems() as $item) {
            if ($item->getProduct()->id() === $this->getContributionProductPrimary()) {
                return true;
            }
        }

        $this->logger->debug('No contribution product found in the cart.');

        return false;
    }

    /**
     * @return ShopableItemEntityInterface|null
     * @throws Exception
     */
    public function getContribution()
    {
        $cart = $this->cartManager->getCurrent();

        /** @var ShopableItemEntityInterface $item */
        foreach ($cart->getItems() as $item) {
            if ($item->getProduct()->id() === $this->getContributionProductPrimary()) {
                return $item;
            }
        }
        
        return null;
    }

    /**
     * @param float $amount
     * @return bool
     * @throws Exception
     */
    public function addContribution($amount)
    {
        try {
            if ($this->hasContribution() === true) {
                $this->removeContribution();
            }

            if (!$this->treeContributionHandler->isValid()) {
                $this->treeContributionHandler->install();
            }

            $contributionProduct = $this->productManager->getByPrimary($this->getContributionProductPrimary());

            $this->cartManager->addItem($contributionProduct, $amount);
        } catch (Exception $exception) {
            $this->logger->error(
                'An error occured while adding contribution to the cart : ' . $exception->getMessage(),
                $exception
            );

            return false;
        }

        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function removeContribution()
    {
        try {
            if (!$this->hasContribution()) {
                $this->logger->debug('Cart does not contain any contribution. Nothing to remove.');
                return true;
            }

            if (!$this->treeContributionHandler->isValid()) {
                $this->treeContributionHandler->install();
            }

            $contributionProduct = $this->productManager->getByPrimary($this->getContributionProductPrimary());

            $this->cartManager->removeItem($contributionProduct);
        } catch (Exception $exception) {
            $this->logger->error(
                'An error occured while removing contribution from the cart : ' . $exception->getMessage(),
                $exception
            );

            return false;
        }

        return true;
    }


    /**
     * @return int
     * @throws Exception
     */
    private function getContributionProductPrimary()
    {
        if ($this->contributionProductPrimary === null) {
            $this->contributionProductPrimary = $this->treeContributionHandler->getPrimary();
        }

        return $this->contributionProductPrimary;
    }
}
