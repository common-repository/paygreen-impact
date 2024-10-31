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

use WC_Product as LocalWC_Product;
use WC_Product_Variation as LocalWC_Product_Variation;
use PGI\Impact\PGDatabase\Foundations\AbstractRepositoryWrapped;
use PGI\Impact\PGShop\Interfaces\Repositories\ProductRepositoryInterface;
use PGI\Impact\PGWooCommerce\Entities\Product;

class ProductRepository extends AbstractRepositoryWrapped implements ProductRepositoryInterface
{
    public function findByPrimary($id)
    {
        $product = wc_get_product($id);

        return (!empty($product)) ? $this->wrapEntity($product) : null;
    }

    public function wrapEntity($localEntity)
    {
        if ($localEntity instanceof LocalWC_Product_Variation) {
            $localEntity = new LocalWC_Product($localEntity->get_parent_id());
        }

        return new Product($localEntity);
    }

    public function findAll()
    {
        $products = wc_get_products(array(
            'status' => 'publish',
            'numberposts' => -1
        ));

        foreach ($products as $product) {
            if ($product instanceof LocalWC_Product_Variation) {
                $product = new LocalWC_Product($product->get_parent_id());
            }
        }

        return $this->wrapEntities($products);
    }
}
