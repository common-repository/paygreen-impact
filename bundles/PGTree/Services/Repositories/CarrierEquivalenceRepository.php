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
use PGI\Impact\PGDatabase\Services\Handlers\DatabaseHandler;
use PGI\Impact\PGShop\Interfaces\Repositories\CarrierEquivalenceRepositoryInterface;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;
use Exception;

/**
 * Class CategoryHasPaymentTypeRepository
 * @package PGPayment\Services\Repositories
 */
class CarrierEquivalenceRepository extends AbstractRepositoryDatabase implements CarrierEquivalenceRepositoryInterface
{

    public function __construct(
        DatabaseHandler $databaseHandler,
        array $config
    ) {
        parent::__construct($databaseHandler, $config);

    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function getReferences()
    {
        $table = "%{database.entities.carrier_equivalence.table}";
        $sql = "SELECT id_carrier FROM `$table`";

        return $this->getRequester()->fetchColumn($sql);
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function getEquivalences()
    {
        $table = "%{database.entities.carrier_equivalence.table}";
        $sql = "SELECT equivalence FROM `$table`";

        return $this->getRequester()->fetchColumn($sql);
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function getEquivalence($id)
    {
        $table = "%{database.entities.carrier_equivalence.table}";
        $sql = "SELECT equivalence FROM `$table` WHERE `id_carrier` = '{$id}'";

        return $this->getRequester()->fetchValue($sql);
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function clean()
    {
        $table = "%{database.entities.carrier_equivalence.table}";
        $sql = "DELETE FROM `$table`";

        return $this->getRequester()->execute($sql);
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function saveAll($data)
    {
        $table = "%{database.entities.carrier_equivalence.table}";
        $sql = "INSERT INTO `$table` (`id_carrier`, `equivalence`) VALUES ";

        $values = array();

        foreach ($data as $row) {
            $values[] = "('{$row['id_carrier']}', '{$row['equivalence']}')";
        }

        $sql .= implode(', ', $values);

        return !empty($values) ? $this->getRequester()->execute($sql) : true;
    }
}
