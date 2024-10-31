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

namespace PGI\Impact\PGCharity\Interfaces\Entities;

use PGI\Impact\PGDatabase\Interfaces\EntityPersistedInterface;
use DateTime;
use Exception;

/**
 * Interface GiftEntityInterface
 * @package PGCharity\Interfaces\Entities
 */
interface GiftEntityInterface extends EntityPersistedInterface
{
    /**
     * @return string
     */
    public function getReference();

    /**
     * @return int
     */
    public function getAmount();

    /**
     * @return string
     */
    public function getCartId();

    /**
     * @return int
     */
    public function getPartnershipId();

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $reference
     * @return self
     */
    public function setReference($reference);

    /**
     * @param int $amount
     * @return self
     */
    public function setAmount($amount);

    /**
     * @param string $id_cart
     * @return self
     */
    public function setCartId($id_cart);

    /**
     * @param int $id_partnership
     * @return self
     */
    public function setPartnershipId($id_partnership);

    /**
     * @param DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt);

    /**
     * @param string $status
     * @return self
     */
    public function setStatus($status);
}
