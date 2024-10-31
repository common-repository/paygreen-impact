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

namespace PGI\Impact\PGWooCommerce\Components\Provisioners;

use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CarrierEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CustomerEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\OrderEntityInterface;
use PGI\Impact\PGShop\Interfaces\Provisioners\PostOrderProvisionerInterface;
use PGI\Impact\PGSystem\Foundations\AbstractObject;
use PGI\Impact\PGWooCommerce\Components\Provisioners\PrePayment as PrePaymentProvisionerComponent;
use PGI\Impact\PGWooCommerce\Entities\Carrier;

/**
 * Class PrePaymentProvisionerComponent
 * @package PGWooCommerce\Components\Provisioners
 */
class PostOrder extends AbstractObject implements PostOrderProvisionerInterface
{
    /** @var OrderEntityInterface|null  */
    private $order = null;

    /** @var CarrierEntityInterface|null */
    private $carrier = null;

    public function __construct(OrderEntityInterface $order)
    {
        $this->order = $order;
        $this->loadCarrier();
    }

    /**
     * @return OrderEntityInterface|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return CustomerEntityInterface|null
     */
    public function getCustomer()
    {
        /** @var LoggerInterface $logger */
        $logger = $this->getService('logger');

        $customer = $this->order->getCustomer();

        if (!$customer) {
            $logger->warning('Customer data not found.');
        }

        return $customer;
    }

    /**
     * @return CarrierEntityInterface|null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    protected function loadCarrier()
    {
        /** @var LoggerInterface $logger */
        $logger = $this->getService('logger');

        $data = array();
        
        $data['name'] = $this->order->getLocalEntity()->get_shipping_method();

        if (!$data['name']) {
            $logger->warning('Carrier data not found.');
        }

        $this->carrier = new Carrier($data);
    }
}