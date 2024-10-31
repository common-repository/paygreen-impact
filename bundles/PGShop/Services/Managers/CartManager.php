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

namespace PGI\Impact\PGShop\Services\Managers;

use PGI\Impact\PGDatabase\Foundations\AbstractManager;
use Exception;
use PGI\Impact\PGShop\Interfaces\Entities\CartEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopableItemEntityInterface;
use PGI\Impact\PGShop\Interfaces\Officers\CartOfficerInterface;
use PGI\Impact\PGShop\Interfaces\Repositories\CartRepositoryInterface;

/**
 * Class CartManager
 *
 * @package PGShop\Services\Managers
 * @method CartRepositoryInterface getRepository()
 */
class CartManager extends AbstractManager
{
    /** @var CartOfficerInterface */
    private $cartOfficer;

    /**
     * @param CartOfficerInterface $cartOfficer
     */
    public function setCartOfficer($cartOfficer)
    {
        $this->cartOfficer = $cartOfficer;
    }

    /**
     * @param int $id
     * @return CartEntityInterface|null
     */
    public function getByPrimary($id)
    {
        return $this->getRepository()->findByPrimary($id);
    }

    /**
     * @return CartEntityInterface|null
     */
    public function getCurrent()
    {
        return $this->getRepository()->findCurrentCart();
    }

    /**
     * @param ProductEntityInterface $product
     * @param float $cost
     * @param string $variationAttribute
     * @return ShopableItemEntityInterface
     * @throws Exception
     */
    public function addItem(ProductEntityInterface $product, $cost, $variationAttribute = "")
    {
        $cart = $this->getCurrent();

        if ($cart === null) {
            throw new Exception('Cart not found.');
        }

        return $this->cartOfficer->addItem($cart, $product, $cost, $variationAttribute);
    }

    /**
     * @param ProductEntityInterface $product
     * @return bool
     * @throws Exception
     */
    public function removeItem(ProductEntityInterface $product)
    {
        $cart = $this->getCurrent();

        if ($cart === null) {
            throw new Exception('Cart not found.');
        }

        return $this->cartOfficer->removeItem($cart, $product);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCurrentCartId() {
        $cart = $this->getCurrent();

        if ($cart === null) {
            throw new Exception('Cart not found.');
        }

        return $cart->id();
    }
}
