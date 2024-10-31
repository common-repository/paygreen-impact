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

namespace PGI\Impact\PGTree\Services\Diagnostics;

use PGI\Impact\PGTree\Services\Handlers\TreeContributionHandler;
use PGI\Impact\PGFramework\Foundations\AbstractDiagnostic;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use Exception;

/**
 * Class TreeContributionDiagnostic
 * @package PGTree\Services\Diagnostics
 */
class TreeContributionDiagnostic extends AbstractDiagnostic
{
    /** @var TreeContributionHandler */
    private $treeContributionHandler;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(TreeContributionHandler $treeContributionHandler, LoggerInterface $logger)
    {
        $this->treeContributionHandler = $treeContributionHandler;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function isValid()
    {
        $result = false;

        try {
            $result = $this->treeContributionHandler->isValid();
        } catch (Exception $exception) {
            $this->logger->error("Critical error during climate contribution diagnostic : " . $exception->getMessage());
        }

        return $result;
    }

    public function resolve()
    {
        try {
            $this->logger->info('Re-install climate contribution product.');

            $this->treeContributionHandler->install();

            return true;
        } catch (Exception $exception) {
            $this->logger->error(
                "Error during climate contribution re-installation : " . $exception->getMessage(),
                $exception
            );
        }

        return false;
    }
}
