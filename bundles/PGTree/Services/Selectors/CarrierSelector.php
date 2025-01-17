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

namespace PGI\Impact\PGTree\Services\Selectors;

use PGI\Impact\PGFramework\Foundations\AbstractSelector;
use PGI\Impact\PGTree\Services\Managers\CarrierManager;

/**
 * Class CarrierSelector
 * @package PGTree\Services\Selectors
 */
class CarrierSelector extends AbstractSelector
{
    /** @var CarrierManager */
    private $carrierManager;

    /**
     * @param CarrierManager $carrierManager
     */
    public function setCarrierManager($carrierManager)
    {
        $this->carrierManager = $carrierManager;
    }

    /**
     * @return array
     */
    protected function buildChoices()
    {
        return $this->carrierManager->getAllNames();
    }
}
