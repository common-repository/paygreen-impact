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

namespace PGI\Impact\PGCharity\Services\Listeners;

use PGI\Impact\PGCharity\Services\Handlers\CharityGiftHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use Exception;

/**
 * Class SetupCharityGiftProductListener
 * @package PGCharity\Services\Listeners
 */
class SetupCharityGiftProductListener
{
    /** @var CharityGiftHandler */
    private $charityGiftHandler;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        CharityGiftHandler $charityGiftHandler,
        LoggerInterface $logger
    ) {
        $this->charityGiftHandler = $charityGiftHandler;
        $this->logger = $logger;
    }

    public function installGiftProduct()
    {
        $this->logger->info("Install Charity gift product.");

        try {
            $this->charityGiftHandler->install();
        } catch (Exception $exception) {
            $this->logger->error(
                "Error during Charity gift product installation : " . $exception->getMessage(),
                $exception
            );
        }
    }

    public function uninstallGiftProduct()
    {
        $this->logger->info("Deactivate Charity gift product.");

        try {
            $this->charityGiftHandler->uninstall();
        } catch (Exception $exception) {
            $this->logger->error(
                "Error during Charity gift product removing : " . $exception->getMessage(),
                $exception
            );
        }
    }
}
