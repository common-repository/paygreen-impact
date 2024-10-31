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

namespace PGI\Impact\PGTree\Services\Repositories;

use PGI\Impact\PGDatabase\Foundations\AbstractRepositoryDatabase;
use PGI\Impact\PGDatabase\Interfaces\EntityPersistedInterface;
use PGI\Impact\PGTree\Interfaces\Entities\CarbonDataEntityInterface;
use PGI\Impact\PGTree\Interfaces\Repositories\CarbonDataRepositoryInterface;
use DateTime;
use Exception;

/**
 * Class CarbonDataRepository
 * @package PGTree\Services\Repositories
 */
class CarbonDataRepository extends AbstractRepositoryDatabase implements CarbonDataRepositoryInterface
{
    const NB_SECONDS_IN_A_DAY = 86400;

    /**
     * @inheritdoc
     * @return EntityPersistedInterface|null
     * @throws Exception
     */
    public function findByPid($pid)
    {
        return $this->findOneEntity("`pid` = '$pid'");
    }

    /**
     * @inheritdoc
     * @return EntityPersistedInterface|null
     * @throws Exception
     */
    public function findByOrderPrimary($id_order)
    {
        $id_order = (int) $id_order;

        return $this->findOneEntity("`id_order` = $id_order");
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function create($id_fingerprint, $footprint, $carbon_offset)
    {
        $createdAt = new DateTime();

        return $this->wrapEntity(array(
            'id_fingerprint' => $id_fingerprint,
            'footprint' => $footprint,
            'carbon_offset' => $carbon_offset,
            'created_at' => $createdAt->getTimestamp()
        ));
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function insert(CarbonDataEntityInterface $carbonData)
    {
        return $this->insertEntity($carbonData);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function update(CarbonDataEntityInterface $carbonData)
    {
        return $this->updateEntity($carbonData);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function delete(CarbonDataEntityInterface $carbonData)
    {
        return $this->deleteEntity($carbonData);
    }
}
