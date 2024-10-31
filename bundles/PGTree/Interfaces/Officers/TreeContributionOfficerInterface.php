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

namespace PGI\Impact\PGTree\Interfaces\Officers;

use Exception;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;

/**
 * Interface TreeContributionOfficerInterface
 * @package PGTree\Interfaces\Interfaces
 */
interface TreeContributionOfficerInterface
{
    /**
     * @param ProductEntityInterface $contribution
     * @param ShopEntityInterface $shop
     * @return bool
     */
    public function isValid($contribution, ShopEntityInterface $shop);

    /**
     * @param ProductEntityInterface $contribution
     * @param ShopEntityInterface $shop
     * @return bool
     */
    public function validate($contribution, ShopEntityInterface $shop);

    /**
     * @param ProductEntityInterface $contribution
     * @param ShopEntityInterface $shop
     * @return bool
     */
    public function disable($contribution, ShopEntityInterface $shop);

    /**
     * @param ShopEntityInterface $shop
     * @return ProductEntityInterface
     */
    public function create(ShopEntityInterface $shop);

    /**
     * @param ShopEntityInterface $shop
     * @return int|null
     * @throws Exception
     */
    public function getPrimary(ShopEntityInterface $shop);
}
