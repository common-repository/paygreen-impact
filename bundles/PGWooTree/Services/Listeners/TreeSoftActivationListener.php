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

namespace PGI\Impact\PGWooTree\Services\Listeners;

use Exception;
use PGI\Impact\PGFramework\Foundations\AbstractService;
use PGI\Impact\PGModule\Services\Handlers\DiagnosticHandler;

/**
 * Class TreeSoftActivationListener
 * @package PGWooTree\Services\Listeners
 */
class TreeSoftActivationListener extends AbstractService
{
    /** @var DiagnosticHandler */
    private $diagnosticHandler;

    public function __construct(DiagnosticHandler $diagnosticHandler)
    {
        $this->diagnosticHandler = $diagnosticHandler;
    }

    /**
     * @return void
     */
    public function checkContributionAvailability()
    {
        $this->log()->debug('ClimateKit SOFT activation detected.');

        try {
            $this->diagnosticHandler->run('true', 'tree_contribution');
        } catch (Exception $exception) {
            $this->log()->error(
                "An error occurred while checking the climate contribution availability : " . $exception->getMessage()
            );
        }
    }
}