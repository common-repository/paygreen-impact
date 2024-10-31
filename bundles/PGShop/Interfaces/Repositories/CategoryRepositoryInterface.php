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

namespace PGI\Impact\PGShop\Interfaces\Repositories;

use PGI\Impact\PGDatabase\Interfaces\RepositoryWrappedEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CategoryEntityInterface;

/**
 * Interface CategoryRepositoryInterface
 * @package PGShop\Interfaces\Repositories
 */
interface CategoryRepositoryInterface extends RepositoryWrappedEntityInterface
{
    /**
     * @return CategoryEntityInterface
     */
    public function findByPrimary($id);

    /**
     * @return CategoryEntityInterface[]
     */
    public function findAll();

    /**
     * @param int $id_shop
     * @return CategoryEntityInterface[]
     */
    public function findAllByShop($id_shop);
}
