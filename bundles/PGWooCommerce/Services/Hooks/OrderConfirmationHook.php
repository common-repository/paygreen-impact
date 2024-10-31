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

namespace PGI\Impact\PGWooCommerce\Services\Hooks;

use PGI\Impact\PGModule\Components\Output as OutputComponent;
use PGI\Impact\PGModule\Services\Providers\OutputProvider;
use PGI\Impact\PGWooCommerce\Entities\Order;

/**
 * Class OrderConfirmationHook
 * @package PGWooCommerce\Services\Hooks
 */
class OrderConfirmationHook
{
    /** @var OutputProvider */
    private $outputProvider;

    private $isAlreadyCalled = false;

    public function __construct(OutputProvider $outputProvider)
    {
        $this->outputProvider = $outputProvider;
    }

    public function displayOrderConfirmationBlock($order_id)
    {
        if (!$this->isAlreadyCalled) {
            $this->isAlreadyCalled = true;

            $data = array(
                'order' => $this->retrieveOrder($order_id)
            );

            /** @var OutputComponent $output */
            $output = $this->outputProvider->getZoneOutput('FRONT.FUNNEL.CONFIRMATION', $data);

            echo $output->getContent();
        }
    }

    /**
     * @param int $order_id
     * @return Order
     */
    protected function retrieveOrder($order_id)
    {
        $local_order = wc_get_order($order_id);
        return new Order($local_order);
    }
}