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

namespace PGI\Impact\PGCharity\Interfaces\Repositories;

use PGI\Impact\PGDatabase\Interfaces\RepositoryInterface;
use PGI\Impact\PGCharity\Interfaces\Entities\GiftEntityInterface;

/**
 * Interface GiftRepositoryInterface
 * @package PGCharity\Interfaces\Repositories
 */
interface GiftRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     * @return GiftEntityInterface|null
     */
    public function findByPrimary($id);

    /**
     * @param string $id_cart
     * @return GiftEntityInterface|null
     */
    public function findByCartPrimary($id_cart);

    /**
     * @param string $reference
     * @return GiftEntityInterface|null
     */
    public function findByReferencePrimary($reference);

    /**
     * @param string $id_cart
     * @return GiftEntityInterface|null
     */
    public function findPledgeByCartPrimary($id_cart);

    /**
     * @param string $reference
     * @param string $id_cart
     * @param int $id_partnership
     * @param int $amount
     * @return GiftEntityInterface
     */
    public function create($reference, $id_cart, $id_partnership, $amount);

    /**
     * @param GiftEntityInterface $gift
     * @return bool
     */
    public function insert(GiftEntityInterface $gift);

    /**
     * @param GiftEntityInterface $gift
     * @return bool
     */
    public function update(GiftEntityInterface $gift);

    /**
     * @param GiftEntityInterface $gift
     * @return bool
     */
    public function delete(GiftEntityInterface $gift);
}
