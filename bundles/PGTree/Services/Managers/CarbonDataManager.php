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

namespace PGI\Impact\PGTree\Services\Managers;

use PGI\Impact\PGDatabase\Foundations\AbstractManager;
use PGI\Impact\PGTree\Interfaces\Entities\CarbonDataEntityInterface;
use PGI\Impact\PGTree\Interfaces\Repositories\CarbonDataRepositoryInterface;
use Exception;

/**
 * Class CarbonDataManager
 * @package PGTree\Services\Managers
 * @method CarbonDataRepositoryInterface getRepository()
 */
class CarbonDataManager extends AbstractManager
{
    /**
     * @param $id
     * @return CarbonDataEntityInterface
     * @throws Exception
     */
    public function getByPrimary($id)
    {
        return $this->getRepository()->findByPrimary($id);
    }

    /**
     * @param string $pid
     * @return CarbonDataEntityInterface|null
     */
    public function getByPid($pid)
    {
        return $this->getRepository()->findByPid($pid);
    }

    /**
     * @param $id_order
     * @return CarbonDataEntityInterface|null
     */
    public function getByOrderPrimary($id_order)
    {
        return $this->getRepository()->findByOrderPrimary($id_order);
    }

    /**
     * @param string $id_fingerprint
     * @param float $footprint
     * @param float $carbon_offset
     * @return CarbonDataEntityInterface
     */
    public function create($id_fingerprint, $footprint, $carbon_offset)
    {
        return $this->getRepository()->create($id_fingerprint, $footprint, $carbon_offset);
    }

    /**
     * @param CarbonDataEntityInterface $carbonData
     * @return bool
     */
    public function save(CarbonDataEntityInterface $carbonData)
    {
        if ($carbonData->id() > 0) {
            return $this->getRepository()->update($carbonData);
        } else {
            return $this->getRepository()->insert($carbonData);
        }
    }
}
