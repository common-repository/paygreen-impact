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

namespace PGI\Impact\FOTree\Services\Listeners;

use PGI\Impact\APITree\Components\Replies\CarbonFootprint as CarbonFootprintReplyComponent;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Components\Events\LocalOrder as LocalOrderEventComponent;
use PGI\Impact\PGShop\Interfaces\Entities\OrderEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopableItemEntityInterface;
use PGI\Impact\PGTree\Services\Handlers\TreeCarbonOffsettingHandler;
use PGI\Impact\PGTree\Services\Handlers\TreeContributionHandler;
use PGI\Impact\PGTree\Services\Repositories\CarbonDataRepository;
use Exception;

/**
 * Class CarbonFootprintFinalizationListener
 * @package FOTree\Services\Listeners
 */
class CarbonFootprintFinalizationListener
{
    /** @var TreeCarbonOffsettingHandler */
    private $treeCarbonOffsettingHandler;

    /** @var CarbonDataRepository */
    private $carbonDataRepository;

    /** @var TreeContributionHandler */
    private $treeContributionHandler;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        TreeCarbonOffsettingHandler $treeCarbonOffsettingHandler,
        CarbonDataRepository $carbonDataRepository,
        TreeContributionHandler $treeContributionHandler,
        LoggerInterface $logger
    ) {
        $this->treeCarbonOffsettingHandler = $treeCarbonOffsettingHandler;
        $this->carbonDataRepository = $carbonDataRepository;
        $this->treeContributionHandler = $treeContributionHandler;
        $this->logger = $logger;
    }

    /**
     * @params PGShopComponentsEventsOrderValidation $event
     * @throws Exception
     */
    public function listen(LocalOrderEventComponent $event)
    {
        try {
            /** @var OrderEntityInterface $order */
            $order = $event->getOrder();

            if ($order === null) {
                throw new Exception("Order is required to finalize carbon footprint.");
            } elseif (!$order instanceof OrderEntityInterface) {
                throw new Exception("Order must be an instance of OrderEntityInterface.");
            }

            $orderId = $order->id();

            if ($this->carbonDataRepository->findByOrderPrimary($orderId) === null) {
                $contributionId = $this->treeContributionHandler->getPrimary();
                $contributionAmount = 0;

                /** @var ShopableItemEntityInterface $item */
                foreach ($order->getItems() as $item) {
                    if ($item->getProduct()->id() === $contributionId) {
                        $contributionAmount += $item->getCost();
                    }
                }

                $this->logger->debug('Carbon user contribution : ', $contributionAmount );

                /** @var CarbonFootprintReplyComponent $carbonFootprintResponse */
                $carbonFootprintResponse = $this->treeCarbonOffsettingHandler->getCarbonOffsetting();

                $this->treeCarbonOffsettingHandler->closeCarbonOffsetting($contributionAmount);

                $this->treeCarbonOffsettingHandler->saveCarbonData($order, $carbonFootprintResponse);

                $this->logger->debug('Carbon footprint successfully finalized.');
            } else {
                $this->logger->debug("Carbon data already exist for order #$orderId.");
            }
        } catch (Exception $exception) {
            $text = "An error occurred during carbon footprint finalization : " .$exception->getMessage();
            $this->logger->error($text, $exception);
        }
    }
}
