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

namespace PGI\Impact\PGCharity\Services\Repositories;

use DateTime;
use Exception;
use PGI\Impact\PGCharity\Interfaces\Entities\GiftEntityInterface;
use PGI\Impact\PGCharity\Interfaces\Repositories\GiftRepositoryInterface;
use PGI\Impact\PGDatabase\Foundations\AbstractRepositoryDatabase;
use PGI\Impact\PGDatabase\Interfaces\EntityPersistedInterface;

class GiftRepository extends AbstractRepositoryDatabase implements GiftRepositoryInterface
{
    /**
     * @inheritdoc
     * @return EntityPersistedInterface|null
     * @throws Exception
     */
    public function findByCartPrimary($id_cart)
    {
        return $this->findOneEntity("`id_cart` = '$id_cart'");
    }

    /**
     * @inheritdoc
     * @return EntityPersistedInterface|null
     * @throws Exception
     */
    public function findByReferencePrimary($reference)
    {
        return $this->findOneEntity("`reference` = '$reference'");
    }

    /**
     * @inheritdoc
     * @return EntityPersistedInterface|null
     * @throws Exception
     */
    public function findPledgeByCartPrimary($id_cart)
    {
        return $this->findOneEntity("`id_cart` = '$id_cart' AND `status` = 'PLEDGE'");
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function create($reference, $id_cart, $id_partnership, $amount)
    {
        $createdAt = new DateTime();

        return $this->wrapEntity(array(
            'reference' => $reference,
            'id_cart' => $id_cart,
            'id_partnership' => $id_partnership,
            'amount' => $amount,
            'created_at' => $createdAt->getTimestamp(),
            'status' => "PLEDGE"
        ));
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function insert(GiftEntityInterface $gift)
    {
        return $this->insertEntity($gift);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function update(GiftEntityInterface $gift)
    {
        return $this->updateEntity($gift);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function delete(GiftEntityInterface $gift)
    {
        return $this->deleteEntity($gift);
    }

}
