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

namespace PGI\Impact\PGWooCharity\Services\Hooks;

use Exception;
use PGI\Impact\PGCharity\Services\Handlers\CharityGiftHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGWooCommerce\Services\Officers\ProductVariationOfficer;

/**
 * Class CleanGiftVariationHook
 * @package PGWooCharity\Services\Hooks
 */
class CleanGiftVariationHook
{
    /** @var CharityGiftHandler */
    private $charityGiftHandler;

    /** @var ProductVariationOfficer */
    private $productVariationOfficer;

    /** @var LoggerInterface */
    private $logger;

    /** @var bool */
    private $isAlreadyCalled = false;

    public function __construct(
        CharityGiftHandler $charityGiftHandler,
        ProductVariationOfficer $productVariationOfficer,
        LoggerInterface $logger
    ) {
        $this->charityGiftHandler = $charityGiftHandler;
        $this->productVariationOfficer = $productVariationOfficer;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function cleanGiftVariations()
    {
        if (!$this->isAlreadyCalled) {
            $this->isAlreadyCalled = true;

            try {
                $this->logger->debug('Clean charity gift product variations.');

                /** @var ProductEntityInterface $gift */
                $gift = $this->charityGiftHandler->get();

                $this->productVariationOfficer->clean($gift);
            } catch (Exception $exception) {
                $this->logger->debug('An error occurred while clean the charity gift product variations.', $exception);
            }
        }
    }
}