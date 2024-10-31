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

namespace PGI\Impact\FOTree\Services\OutputBuilders;

use PGI\Impact\FOTree\Services\Handlers\CarbonRounderHandler;
use PGI\Impact\PGModule\Components\Output as OutputComponent;
use PGI\Impact\PGModule\Foundations\AbstractOutputBuilder;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\OrderEntityInterface;
use PGI\Impact\PGTree\Interfaces\Entities\CarbonDataEntityInterface;
use PGI\Impact\PGTree\Services\Managers\CarbonDataManager;
use PGI\Impact\PGModule\Services\Settings;
use Exception;

/**
 * Class CarbonFootprintOutputBuilder
 * @package FOTree\Services\OutputBuilders
 */
class CarbonFootprintOutputBuilder extends AbstractOutputBuilder
{
    /** @var CarbonDataManager */
    private $carbonDataManager;

    /** @var CarbonRounderHandler */
    private $carbonRounderHandler;

    /** @var LoggerInterface */
    private $logger;

    /** @var Settings */
    private $settings;

    public function __construct(
        CarbonDataManager $carbonDataManager,
        CarbonRounderHandler $carbonRounderHandler,
        LoggerInterface $logger,
        Settings $settings
    ) {
        parent::__construct();

        $this->carbonDataManager = $carbonDataManager;
        $this->carbonRounderHandler = $carbonRounderHandler;
        $this->logger = $logger;
        $this->settings = $settings;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function build(array $data = array())
    {
        if (!array_key_exists('order', $data)) {
            throw new Exception("Order is required to build carbon footprint.");
        } elseif (! $data['order'] instanceof OrderEntityInterface) {
            throw new Exception("Order must be an instance of OrderEntityInterface.");
        }

        /** @var OrderEntityInterface $order */
        $order = $data['order'];
        $output = new OutputComponent();

        /** @var CarbonDataEntityInterface|null $carbonData */
        $carbonData = $this->carbonDataManager->getByOrderPrimary($order->id());

        $isTreeTestModeActivated = $this->settings->get('tree_test_mode');

        if ($carbonData !== null) {
            $content = $this->getViewHandler()->renderTemplate('carbon-offset-merchant', array(
                "carbon_offset" => $this->carbonRounderHandler->roundNumber(
                    $carbonData->getFootprint()
                ),
                'isTreeTestModeActivated' => $isTreeTestModeActivated
            ));

            $output->setContent($content);
        } else {
            $this->logger->error("Unable to retrieve CarbonData for order #{$order->id()}.");
        }

        return $output;
    }
}
