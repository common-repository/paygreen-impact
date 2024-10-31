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

namespace PGI\Impact\PGWooCommerce\Services\Repositories;

use WC_Customer as LocalWC_Customer;
use PGI\Impact\PGDatabase\Foundations\AbstractRepositoryWrapped;
use PGI\Impact\PGShop\Interfaces\Repositories\CustomerRepositoryInterface;
use PGI\Impact\PGWooCommerce\Entities\Customer;

class CustomerRepository extends AbstractRepositoryWrapped implements CustomerRepositoryInterface
{
    public function findByPrimary($id)
    {
        $localCustomer = new LocalWC_Customer($id);

        return $localCustomer ? $this->wrapEntity($localCustomer) : null;
    }

    public function findCurrentCustomer()
    {
        global $woocommerce;

        return $this->wrapEntity($woocommerce->customer);
    }

    /**
     * @param LocalWC_Customer $localEntity
     * @return Customer
     */
    public function wrapEntity($localEntity)
    {
        return new Customer($localEntity);
    }
}
