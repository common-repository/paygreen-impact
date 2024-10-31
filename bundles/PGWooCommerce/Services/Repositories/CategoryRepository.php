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

use WP_Term as LocalWP_Term;
use PGI\Impact\PGDatabase\Foundations\AbstractRepositoryWrapped;
use PGI\Impact\PGShop\Interfaces\Repositories\CategoryRepositoryInterface;
use PGI\Impact\PGWooCommerce\Entities\Category;

class CategoryRepository extends AbstractRepositoryWrapped implements CategoryRepositoryInterface
{
    /**
     * @param LocalWP_Term $localEntity
     * @return Category
     */
    public function wrapEntity($localEntity)
    {
        return new Category($localEntity);
    }

    public function findByPrimary($id)
    {
        $term = get_term($id);

        return $this->wrapEntity($term);
    }

    /**
     * @inheritdoc
     */
    public function findAll()
    {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'orderBy' => 'name',
            'hierarchical' => 1,
            'hide_empty' => false
        ));

        return $this->wrapEntities($terms);
    }

    /**
     * @inheritdoc
     */
    public function findAllByShop($id_shop)
    {
        return $this->findAll();
    }
}
