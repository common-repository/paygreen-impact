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

namespace PGI\Impact\PGTree\Interfaces\Repositories;

use PGI\Impact\PGDatabase\Interfaces\RepositoryInterface;
use PGI\Impact\PGTree\Interfaces\Entities\CarbonDataEntityInterface;

/**
 * Interface CarbonDataRepositoryInterface
 * @package PGTree\Interfaces\Repositories
 */
interface CarbonDataRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     * @return CarbonDataEntityInterface|null
     */
    public function findByPrimary($id);

    /**
     * @param int $id_order
     * @return CarbonDataEntityInterface|null
     */
    public function findByOrderPrimary($id_order);

    /**
     * @param string $pid
     * @return CarbonDataEntityInterface|null
     */
    public function findByPid($pid);

    /**
     * @param string $id_fingerprint
     * @param float $footprint
     * @param float $carbon_offset
     * @return CarbonDataEntityInterface
     */
    public function create($id_fingerprint, $footprint, $carbon_offset);

    /**
     * @param CarbonDataEntityInterface $carbonData
     * @return bool
     */
    public function insert(CarbonDataEntityInterface $carbonData);

    /**
     * @param CarbonDataEntityInterface $carbonData
     * @return bool
     */
    public function update(CarbonDataEntityInterface $carbonData);

    /**
     * @param CarbonDataEntityInterface $carbonData
     * @return bool
     */
    public function delete(CarbonDataEntityInterface $carbonData);
}
