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

namespace PGI\Impact\PGWooCharity\Services\Diagnostics;

use PGI\Impact\PGCharity\Services\Handlers\CharityGiftHandler;
use PGI\Impact\PGFramework\Foundations\AbstractDiagnostic;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use Exception;

/**
 * Class CharityGiftDiagnostic
 * @package PGWooCharity\Services\Diagnostics
 */
class CharityGiftDiagnostic extends AbstractDiagnostic
{
    /** @var CharityGiftHandler */
    private $charityGiftHandler;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(CharityGiftHandler $charityGiftHandler, LoggerInterface $logger)
    {
        $this->charityGiftHandler = $charityGiftHandler;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function isValid()
    {
        if (!$this->isDiagnosticAvailable()) {
            $this->logger->warning("CharityGiftDiagnostic diagnostic is not available.");
            return true;
        }

        $result = false;

        try {
            $result = $this->charityGiftHandler->isValid();
        } catch (Exception $exception) {
            $this->logger->error("Critical error during charity gift diagnostic : " . $exception->getMessage());
        }

        return $result;
    }

    public function resolve()
    {
        if (!$this->isDiagnosticAvailable()) {
            $this->logger->warning("CharityGiftDiagnostic diagnostic is not available.");
            return true;
        }

        try {
            $this->logger->info('Re-install charity gift product.');

            $this->charityGiftHandler->install();

            return true;
        } catch (Exception $exception) {
            $this->logger->error(
                "Error during charity gift re-installation : " . $exception->getMessage(),
                $exception
            );
        }

        return false;
    }

    /**
     * @return bool
     */
    private function isDiagnosticAvailable()
    {
        global $wp_query;

        return (isset($wp_query));
    }
}
