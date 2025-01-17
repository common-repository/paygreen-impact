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

namespace PGI\Impact\PGModule\Services\Listeners;

use PGI\Impact\PGModule\Components\Events\Module as ModuleEventComponent;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Upgrader;
use Exception;

/**
 * Class UpgradeListener
 * @package PGModule\Services\Listeners
 */
class UpgradeListener
{
    /** @var Upgrader */
    private $upgrader;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(Upgrader $upgrader, LoggerInterface $logger)
    {
        $this->upgrader = $upgrader;
        $this->logger = $logger;
    }

    public function listen(ModuleEventComponent $event)
    {
        try {
            $this->upgrader->upgrade($event->getLastUpdate(), PGIMPACT_MODULE_VERSION);
        } catch (Exception $exception) {
            $this->logger->error("Error during module upgrade : " . $exception->getMessage(), $exception);
        }
    }
}
