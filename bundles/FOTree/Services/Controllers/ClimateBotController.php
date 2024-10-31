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

namespace PGI\Impact\FOTree\Services\Controllers;

use PGI\Impact\APITree\Components\Replies\CarbonFootprint as CarbonFootprintReplyComponent;
use PGI\Impact\APITree\Services\Facades\ApiFacade;
use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGFramework\Services\Handlers\CookieHandler;
use PGI\Impact\PGIntl\Services\Translator;
use PGI\Impact\PGServer\Components\Responses\PaygreenModule as PaygreenModuleResponseComponent;
use PGI\Impact\PGShop\Interfaces\Entities\CarrierEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CartEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\CustomerEntityInterface;
use PGI\Impact\PGShop\Services\Managers\CartManager;
use PGI\Impact\PGShop\Services\Managers\CustomerManager;
use PGI\Impact\PGTree\Services\Filters\ProductReferenceFilter;
use PGI\Impact\PGTree\Services\Handlers\TreeCarbonOffsettingHandler;
use Exception;
use PGI\Impact\PGTree\Services\Handlers\TreeFootprintIdHandler;
use PGI\Impact\PGTree\Services\Handlers\TreeFootprintTokenHandler;
use PGI\Impact\PGTree\Services\Managers\CarrierEquivalenceManager;

/**
 * Class ClimateBotController
 * @package FOTree\Services\Controllers
 */
class ClimateBotController extends AbstractBackofficeController
{
    /** @var CustomerManager */
    private $customerManager;

    /** @var CartManager */
    private $cartManager;

    /** @var ApiFacade */
    private $apiFacade;

    /** @var TreeCarbonOffsettingHandler */
    private $carbonOffsettingHandler;

    /** @var TreeFootprintTokenHandler */
    private $treeFootprintTokenHandler;

    /** @var TreeFootprintIdHandler */
    private $treeFootprintIdHandler;

    /** @var ProductReferenceFilter ProductReferenceFilter */
    private $productReferenceFilter;

    /** @var CarrierEquivalenceManager */
    private $carrierEquivalenceManager;

    /** @var CookieHandler */
    private $cookieHandler;

    /** @var Translator */
    private $translator;

    public function __construct(
        CustomerManager $customerManager,
        CartManager $cartManager,
        ApiFacade $apiFacade,
        TreeCarbonOffsettingHandler $carbonOffsettingHandler,
        TreeFootprintTokenHandler $treeFootprintTokenHandler,
        TreeFootprintIdHandler $footprintIdHandler,
        ProductReferenceFilter $productReferenceFilter,
        CarrierEquivalenceManager $carrierEquivalenceManager,
        CookieHandler $cookieHandler,
        Translator $translator
    ) {
        $this->customerManager = $customerManager;
        $this->cartManager = $cartManager;
        $this->apiFacade = $apiFacade;
        $this->carbonOffsettingHandler = $carbonOffsettingHandler;
        $this->treeFootprintTokenHandler = $treeFootprintTokenHandler;
        $this->treeFootprintIdHandler = $footprintIdHandler;
        $this->productReferenceFilter = $productReferenceFilter;
        $this->carrierEquivalenceManager = $carrierEquivalenceManager;
        $this->cookieHandler = $cookieHandler;
        $this->translator = $translator;
    }

    /**
     * @return PaygreenModuleResponseComponent
     * @throws Exception
     */
    public function createFootprintAction()
    {
        /** @var CartEntityInterface $cart */
        $cart = $this->cartManager->getCurrent();

        /** @var CustomerEntityInterface $customer */
        $customer = $this->customerManager->getCurrent();

        try {
            /** @var CarbonFootprintReplyComponent $carbonFootprint */
            $carbonFootprint = $this->carbonOffsettingHandler->getCarbonOffsetting();

            if (!in_array($carbonFootprint->getStatus(), array('CREATED', 'ONGOING'))) {
                $this->getLogger()->error("Footprint '{$carbonFootprint->getIdFootprint()}' is not in valid status. Unrecognized status : '{$carbonFootprint->getStatus()}'.");
                $id = $this->treeFootprintIdHandler->createFootprintId();
                $carbonFootprint = $this->apiFacade->getCarbonFootprintEstimation($id);
            }
        } catch (Exception $exception) {
            $id = $this->cookieHandler->get(TreeFootprintIdHandler::FOOTPRINT_ID_COOKIE_NAME);
            $this->getLogger()->error("Footprint '{$id}' not found.");
            $id = $this->treeFootprintIdHandler->createFootprintId();
            $carbonFootprint = $this->apiFacade->getCarbonFootprintEstimation($id);
        }

        $fingerprint = $carbonFootprint->getFingerprint();
        $idUser = $carbonFootprint->getIdUser();
        $token = $this->treeFootprintTokenHandler->getToken($fingerprint);

        $response = new PaygreenModuleResponseComponent($this->getRequest());
        $response
            ->addData('fingerprint', $fingerprint)
            ->addData('userId', $idUser)
            ->addData('token', $token)
        ;

        if ($cart !== null) {
            $response
                ->addData('cart', $this->getCart($cart))
            ;

            $shippingFromAddress = $this->getShippingFromAddress();
            $shippingToAddress = $this->getShippingToAddress($cart, $customer);

            $deliveryService = $this->getDeliveryService($cart->getCarrier());

            if ($shippingFromAddress !== null && $shippingToAddress !== null) {
                $response
                    ->addData('shippingFromAddress', $this->getShippingFromAddress())
                    ->addData('shippingToAddress', $this->getShippingToAddress($cart, $customer))
                    ->addData('deliveryService', $deliveryService)
                ;
            }
        } else {
            $this->getLogger()->debug("Missing cart to compute footprint emission.");
        }

        return $response;
    }

    /**
     * @param CartEntityInterface $cart
     *
     * @return array
     *
     * @throws Exception
     */
    private function getCart(CartEntityInterface $cart)
    {
        $products = array(
            'price' => $cart->getTotalCost(),
            'weight' => $cart->getShippingWeight(),
            'items' => array()
        );

        $parameters = $this->getParameters();

        foreach ($cart->getItems() as $item) {
            $reference = $item->getProduct()->getReference();

            if (!in_array($reference, $parameters['catalog_export.excluded_products'])) {
                $products['items'][] = array(
                    'productExternalReference' => $this->productReferenceFilter->filter($reference),
                    'quantity' => $item->getQuantity(),
                    'exTaxPriceInCents' => $item->getCost()
                );
            }
        }

        return $products;
    }

    /**
     * @return array|null
     *
     * @throws Exception
     */
    private function getShippingFromAddress()
    {
        $settings = $this->getSettings();

        $address = array();

        $address['street'] = $settings->get('shipping_address_line_1');
        $address['postcode'] = $settings->get('shipping_address_zipcode');
        $address['city'] = $settings->get('shipping_address_city');

        $shipping_address_line_2 = $settings->get('shipping_address_line_2');

        if (!empty($shipping_address_line_2)) {
            $address['address'] .= ', ' . $shipping_address_line_2;
        }

        $iso = $settings->get('shipping_address_country');
        $address['country'] = $this->translator->get("countries.$iso");

        foreach ($address as $key => $value) {
            if (empty($value)) {
                $this->getLogger()->error("Merchant deposit address is invalid '$key' is empty : ", $value);
            }
        }

        if (empty($address['street'])) {
            return null;
        }

        return $address;
    }

    /**
     * @param CartEntityInterface $cart
     * @param null|CustomerEntityInterface $customer
     *
     * @return array|null
     *
     * @throws Exception
     */
    private function getShippingToAddress(CartEntityInterface $cart, $customer)
    {
        if ($cart->getShippingAddress() !== null) {
            $shippingAddress = $cart->getShippingAddress();
        } elseif (($customer !== null) && ($customer->getShippingAddress() !== null)) {
            $shippingAddress = $customer->getShippingAddress();
        } else {
            $this->getLogger()->debug("Missing address to compute 'Transportation' footprint.");
            return null;
        }

        $iso = strtolower($shippingAddress->getCountry());
        $country = $this->translator->get("countries.$iso");

        return array(
            'street' => $shippingAddress->getFullAddressLine(),
            'postcode' => $shippingAddress->getZipCode(),
            'city' => $shippingAddress->getCity(),
            'country' => ($country !== null) ? $country : $iso
        );
    }

    /**
     * @param null|CarrierEntityInterface $carrier
     *
     * @return string|null
     */
    private function getDeliveryService($carrier)
    {
        $deliveryEquivalence = 'DEFAULT';

        if ($carrier !== null) {
            $idCarrier = $carrier->id();
            $deliveryEquivalence = $this->carrierEquivalenceManager->getEquivalence($idCarrier);
        }

        if ($deliveryEquivalence === 'SHOP') {
            $this->getLogger()->info('Shop pick up selected, no transportation added.');

            return null;
        }

        return $deliveryEquivalence;
    }
}
