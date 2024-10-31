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

namespace PGI\Impact\PGWooTree\Services\Hooks;

use Exception;
use PGI\Impact\PGTree\Services\Handlers\TreeContributionHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGWooCommerce\Services\Officers\ProductVariationOfficer;

/**
 * Class CleanContributionVariationHook
 * @package PGWooTree\Services\Hooks
 */
class CleanContributionVariationHook
{
    /** @var TreeContributionHandler */
    private $treeContributionHandler;

    /** @var ProductVariationOfficer */
    private $productVariationOfficer;

    /** @var LoggerInterface */
    private $logger;

    /** @var bool */
    private $isAlreadyCalled = false;

    public function __construct(
        TreeContributionHandler $treeContributionHandler,
        ProductVariationOfficer $productVariationOfficer,
        LoggerInterface $logger
    ) {
        $this->treeContributionHandler = $treeContributionHandler;
        $this->productVariationOfficer = $productVariationOfficer;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function cleanContributionVariations()
    {
        if (!$this->isAlreadyCalled) {
            $this->isAlreadyCalled = true;

            try {
                $this->logger->debug('Clean tree contribution product variations.');

                /** @var ProductEntityInterface $contribution */
                $contribution = $this->treeContributionHandler->get();

                $this->productVariationOfficer->clean($contribution);
            } catch (Exception $exception) {
                $this->logger->debug('An error occurred while clean the tree contribution product variations.', $exception);
            }
        }
    }
}