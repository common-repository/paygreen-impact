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

namespace PGI\Impact\PGWordPress\Services\Handlers;

use PGI\Impact\PGFramework\Services\Handlers\OutputHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Providers\OutputProvider;
use PGI\Impact\PGWordPress\Services\Compilers\StaticResourceCompiler;
use Exception;

class FrontofficeHandler
{
    /** @var StaticResourceCompiler */
    private $wordpressResourceHandler;

    /** @var LoggerInterface */
    private $logger;

    /** @var OutputProvider $outputProvider */
    private $outputProvider;

    public function __construct(
        StaticResourceCompiler $wordpressResourceHandler,
        LoggerInterface $logger,
        OutputProvider $outputProvider
    ) {
        $this->wordpressResourceHandler = $wordpressResourceHandler;
        $this->logger = $logger;
        $this->outputProvider = $outputProvider;
    }

    public function run()
    {
        try {
            $this->logger->debug("Building frontoffice output.");

            /** @var OutputHandler $output */
            $output = $this->outputProvider->getZoneOutput('FRONT.PAYGREEN');

            $this->wordpressResourceHandler->insertResources($output->getResources());

            return $output->getContent();
        } catch (Exception $exception) {
            $text = "Error during frontoffice building : " . $exception->getMessage();
            $this->logger->error($text, $exception);

            return $text;
        }
    }
}
