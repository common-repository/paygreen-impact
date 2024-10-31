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

namespace PGI\Impact\PGWooCharity\Services\Officers;

use PGI\Impact\PGDatabase\Interfaces\EntityWrappedInterface;
use PGI\Impact\PGIntl\Services\Translator;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use WC_Product as LocalWC_Product;
use WC_Product_Attribute as LocalWC_Product_Attribute;
use WC_Product_Variable as LocalWC_Product_Variable;
use Exception;
use PGI\Impact\PGCharity\Interfaces\Officers\CharityGiftOfficerInterface;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGShop\Services\Managers\ProductManager;
use PGI\Impact\PGSystem\Components\Parameters;

/**
* Class CharityGiftOfficer
* @package PGWooCharity\Services\Officers
*/
class CharityGiftOfficer implements CharityGiftOfficerInterface
{
    /** @var CharityGiftImageOfficer */
    protected $charityGiftImageOfficer;

    /** @var ProductManager */
    private $productManager;

    /** @var Translator */
    private $translator;

    /** @var Parameters */
    private $parameters;

    /** @var Settings */
    private $settings;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        CharityGiftImageOfficer $charityGiftImageOfficer,
        ProductManager $productManager,
        Translator $translator,
        Parameters $parameters,
        Settings $settings,
        LoggerInterface $logger
    ) {
        $this->charityGiftImageOfficer = $charityGiftImageOfficer;
        $this->productManager = $productManager;
        $this->translator = $translator;
        $this->parameters = $parameters;
        $this->settings = $settings;
        $this->logger = $logger;
    }

    /**
     * @param ShopEntityInterface $shop
     * @return int|null
     * @throws Exception
     */
    public function getPrimary(ShopEntityInterface $shop)
    {
        $result = null;

        $primary = $this->settings->get('charity_gift_id');

        if (empty($primary)) {
            $primary = wc_get_product_id_by_sku($this->parameters['data.charity_gift.reference']);
        }

        if (!empty($primary)) {
            $gift = $this->productManager->getByPrimary($primary);

            if ($gift !== null) {
                $result = $primary;
                $this->settings->set('charity_gift_id', $primary);
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function isValid($gift, ShopEntityInterface $shop)
    {
        $isActive = $this->isActive($gift);
        $isNotEligibleToTaxes = $this->isNotEligibleToTaxes($gift);
        $isImageInstalled = ($this->charityGiftImageOfficer->getGiftImageId($gift) !== null);
        $hasAssociatedImage = $this->charityGiftImageOfficer->hasAssociatedImage($gift);
        $hasRightAttributeName = $this->hasRightAttributeName($gift);

        return ($isActive && $isNotEligibleToTaxes && $isImageInstalled && $hasAssociatedImage && $hasRightAttributeName);
    }

    /**
     * @inheridoc
     */
    public function validate($gift, ShopEntityInterface $shop)
    {
        $result = false;

        try {
            $this->logger->debug("Charity gift product validation.");

            /** @var LocalWC_Product $localGift */
            $localGift = $gift->getLocalEntity();

            if (!$this->isActive($gift)) {
                $this->logger->debug("Update gift status.");
                $localGift->set_status('publish');
            }

            if (!$this->isNotEligibleToTaxes($gift)) {
                $this->logger->debug("Disable taxes on the gift product.");
                $localGift->set_tax_status('none');
            }

            if (!$this->hasRightAttributeName($gift)) {
                $this->logger->info("Update attribute name 'pg_product_type' -> 'pg_variation_attribute'.");

                $variationAttribute = new LocalWC_Product_Attribute();
                $variationAttribute->set_name('pg_variation_attribute');
                $variationAttribute->set_position(0);
                $variationAttribute->set_visible(true);
                $variationAttribute->set_variation(true);

                $localGift->set_attributes(array($variationAttribute));
            }

            if (($this->charityGiftImageOfficer->getGiftImageId($gift) === null)) {
                $this->charityGiftImageOfficer->install($gift);
            }

            if (!$this->charityGiftImageOfficer->hasAssociatedImage($gift)) {
                $this->charityGiftImageOfficer->associate($gift);
            }

            $localGift->save();

            $result = true;
        } catch (Exception $exception) {
            $this->logger->error('An error occurred during charity gift product validation.');
        }

        return $result;
    }

    /**
     * @inheridoc
     */
    public function disable($gift, ShopEntityInterface $shop)
    {
        try {
            $this->logger->debug('Disable charity gift product.');

            /** @var LocalWC_Product $localGift */
            $localGift = $gift->getLocalEntity();

            $localGift->set_status('pending');
            $localGift->save();

            return true;
        } catch (Exception $exception) {
            $this->logger->error('An error occurred while deactivating the charity gift product.', $exception);
        }

        return false;
    }

    /**
     * @inheridoc
     * @throws Exception
     */
    public function create(ShopEntityInterface $shop)
    {
        $this->logger->notice("Creating charity gift product.");

        /** @var ProductEntityInterface $gift */
        $gift = $this->createWrappedEntity();

        $this->insertLocalEntity($gift->getLocalEntity());

        $this->charityGiftImageOfficer->install($gift, $shop);

        $this->settings->set('charity_gift_id', $gift->id());

        return $gift;
    }

    /**
     * @return EntityWrappedInterface
     * @throws Exception
     */
    private function createWrappedEntity()
    {
        try {
            $localProduct = new LocalWC_Product_Variable();
            $localProduct->set_name($this->translator->get(
                'data.charity_gift.name',
                'fr')
            );
            $localProduct->set_description($this->translator->get(
                'data.charity_gift.description',
                'fr')
            );

            $localProduct->set_slug($this->parameters['data.charity_gift.reference']);
            $localProduct->set_sku($this->parameters['data.charity_gift.reference']);
            $localProduct->set_regular_price('0');
            $localProduct->set_price('0');
            $localProduct->set_virtual(true);
            $localProduct->set_catalog_visibility('hidden');
            $localProduct->set_tax_status('none');

            $variationAttribute = new LocalWC_Product_Attribute();
            $variationAttribute->set_name('pg_variation_attribute');
            $variationAttribute->set_position(0);
            $variationAttribute->set_visible(true);
            $variationAttribute->set_variation(true);

            $localProduct->set_attributes(array($variationAttribute));

            return $this->productManager->getRepository()->wrapEntity($localProduct);
        } catch (Exception $exception) {
            $this->logger->critical("An error occurred during local gift product creation.", $exception);

            throw $exception;
        }
    }

    /**
     * @param LocalWC_Product $localProduct
     * @return void
     * @throws Exception
     */
    private function insertLocalEntity(LocalWC_Product $localProduct)
    {
        try {
            if ($localProduct->get_id() > 0) {
                throw new Exception("Local product already exists : 'Product#{$localProduct->get_id()}'.");
            }

            $localProduct->save_meta_data();
            $localProduct->save();
        } catch (Exception $exception) {
            $this->logger->critical("Error during inserting product : " . $exception->getMessage(), $exception);

            throw $exception;
        }
    }

    /**
     * @param ProductEntityInterface $gift
     * @return bool
     */
    private function isActive(ProductEntityInterface $gift)
    {
        return ($gift->getLocalEntity()->get_status() === 'publish');
    }

    /**
     * @param ProductEntityInterface $gift
     * @return bool
     */
    private function isNotEligibleToTaxes(ProductEntityInterface $gift)
    {
        return ($gift->getLocalEntity()->get_tax_status() === 'none');
    }

    /**
     * @param ProductEntityInterface $gift
     * @return bool
     */
    private function hasRightAttributeName(ProductEntityInterface $gift)
    {
        $attributes = $gift->getLocalEntity()->get_attributes();

        return (isset( $attributes['pg_variation_attribute']));
    }
}