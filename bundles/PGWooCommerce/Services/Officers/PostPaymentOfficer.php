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

namespace PGI\Impact\PGWooCommerce\Services\Officers;

use PGI\Impact\APIPayment\Components\Replies\Transaction as TransactionReplyComponent;
use PGI\Impact\PGShop\Interfaces\Officers\PostPaymentOfficerInterface;
use PGI\Impact\PGShop\Interfaces\Provisioners\PostPaymentProvisionerInterface;
use PGI\Impact\PGShop\Services\Managers\OrderManager;
use PGI\Impact\PGSystem\Foundations\AbstractObject;
use PGI\Impact\PGWooCommerce\Components\Provisioners\PostPayment as PostPaymentProvisionerComponent;
use Exception;

class PostPaymentOfficer extends AbstractObject implements PostPaymentOfficerInterface
{
    /**
     * @inheritDoc
     */
    public function getOrder(PostPaymentProvisionerInterface $provisioner)
    {
        /** @var OrderManager $orderManager */
        $orderManager = $this->getService('manager.order');

        $id_order = $provisioner->getTransaction()->getMetadata('order_id');

        /** @var WC_Order|null $order */
        $order = $orderManager->getByPrimary($id_order);

        if ($order === null) {
            throw new Exception("Order #{$id_order} not found.");
        }

        return $order;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function createOrder(PostPaymentProvisionerInterface $provisioner, $state)
    {
        throw new Exception("Not implemented.");
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function buildPostPaymentProvisioner($pid, TransactionReplyComponent $transaction)
    {
        return new PostPaymentProvisionerComponent($pid, $transaction);
    }
}
