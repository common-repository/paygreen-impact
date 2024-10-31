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
use PGI\Impact\PGShop\Interfaces\Repositories\CarrierEquivalenceRepositoryInterface;


/**
 * Class CarrierEquivalenceManager
 *
 * @package PGTree\Services\Managers
 * @method CarrierEquivalenceRepositoryInterface getRepository
 */
class CarrierEquivalenceManager extends AbstractManager
{
    /**
     * @param array $carrierEquivalence
     */
    public function saveCarrierEquivalence(array $carrierEquivalence)
    {
        $carrierRows = array();


        foreach ($carrierEquivalence as $id_carrier => $equivalence) {
                $carrierRows[] = array(
                    'id_carrier' => $id_carrier,
                    'equivalence' => $equivalence
                );
        }

        $this->getRepository()->clean();
        $this->getRepository()->saveAll($carrierRows);
    }

    /**
     * @return array
     */
    public function getReferences()
    {
        return $this->getRepository()->getReferences();
    }

    /**
     * @return array
     */
    public function getEquivalences()
    {
        return $this->getRepository()->getEquivalences();
    }

    /**
     * @param int $id
     * @return string
     */
    public function getEquivalence($id)
    {
        return $this->getRepository()->getEquivalence($id);
    }
}
