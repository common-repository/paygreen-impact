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

namespace PGI\Impact\PGShop\Interfaces\Entities;

use PGI\Impact\PGShop\Interfaces\Entities\AddressEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CurrencyEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopableItemEntityInterface;
use PGI\Impact\PGShop\Interfaces\ShopableInterface;

/**
 * Interface CartEntityInterface
 * @package PGShop\Interfaces\Entities
 */
interface CartEntityInterface extends ShopableInterface
{
    /**
     * @return ShopableItemEntityInterface[]
     */
    public function getItems();

    /**
     * @return int
     */
    public function getTotalCost();

    /**
     * @return int
     */
    public function getShippingCost();

    /**
     * @return float
     */
    public function getShippingWeight();

    /**
     * @return CurrencyEntityInterface
     */
    public function getCurrency();

    /**
     * @return AddressEntityInterface|null
     */
    public function getShippingAddress();

    /**
     * @return AddressEntityInterface|null
     */
    public function getBillingAddress();
}
