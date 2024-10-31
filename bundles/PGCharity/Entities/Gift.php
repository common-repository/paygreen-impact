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

namespace PGI\Impact\PGCharity\Entities;

use DateTime;
use PGI\Impact\PGCharity\Interfaces\Entities\GiftEntityInterface;
use PGI\Impact\PGDatabase\Foundations\AbstractEntityPersisted;

class Gift extends AbstractEntityPersisted implements GiftEntityInterface
{
    public function getReference()
    {
        return $this->get('reference');
    }

    public function setReference($reference)
    {
        $this->set('reference', $reference);

        return $this;
    }

    public function getAmount()
    {
        return $this->get('amount');
    }

    public function setAmount($amount)
    {
        $this->set('amount', $amount);

        return $this;
    }

    public function getCartId()
    {
        return $this->get('id_cart');
    }

    public function setCartId($id_cart)
    {
        $this->set('id_cart', $id_cart);

        return $this;
    }

    public function getPartnershipId()
    {
        return $this->get('id_partnership');
    }

    public function setPartnershipId($id_partnership)
    {
        $this->set('id_partnership', $id_partnership);

        return $this;
    }

    public function getCreatedAt()
    {
        $timestamp = (int) $this->get('created_at');

        $dt = new DateTime();

        return $dt->setTimestamp($timestamp);
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->set('created_at', $createdAt->getTimestamp());

        return $this;
    }

    public function getStatus()
    {
        return $this->get('status');
    }

    public function setStatus($status)
    {
        $this->set('status', $status);

        return $this;
    }
}
