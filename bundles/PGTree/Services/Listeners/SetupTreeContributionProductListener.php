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

namespace PGI\Impact\PGTree\Services\Listeners;

use PGI\Impact\PGTree\Services\Handlers\TreeContributionHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use Exception;

/**
 * Class SetupTreeContributionProductListener
 * @package PGTree\Services\Listeners
 */
class SetupTreeContributionProductListener
{
    /** @var TreeContributionHandler */
    private $treeContributionHandler;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        TreeContributionHandler $treeContributionHandler,
        LoggerInterface $logger
    ) {
        $this->treeContributionHandler = $treeContributionHandler;
        $this->logger = $logger;
    }

    public function installContributionProduct()
    {
        $this->logger->info("Install Climate contribution product.");

        try {
            $this->treeContributionHandler->install();
        } catch (Exception $exception) {
            $this->logger->error(
                "Error during Climate contribution product installation : " . $exception->getMessage(),
                $exception
            );
        }
    }

    public function uninstallContributionProduct()
    {
        $this->logger->info("Deactivate Climate contribution product.");

        try {
            $this->treeContributionHandler->uninstall();
        } catch (Exception $exception) {
            $this->logger->error(
                "Error during Climate contribution product removing : " . $exception->getMessage(),
                $exception
            );
        }
    }
}
