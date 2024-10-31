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
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use PGI\Impact\PGShop\Interfaces\Repositories\ShopRepositoryInterface;

/**
 * Class ShopManager
 *
 * @package PGShop\Services\Managers
 * @method ShopRepositoryInterface getRepository()
 */
class ShopManager extends AbstractManager
{
    /**
     * @param $id
     * @return ShopEntityInterface|null
     */
    public function getByPrimary($id)
    {
        return $this->getRepository()->findByPrimary($id);
    }

    /**
     * @return ShopEntityInterface
     */
    public function getCurrent()
    {
        return $this->getRepository()->findCurrent();
    }

    public function getAll()
    {
        return $this->getRepository()->findAll();
    }
}
