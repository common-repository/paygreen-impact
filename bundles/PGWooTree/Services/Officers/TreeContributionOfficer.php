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

namespace PGI\Impact\PGWooTree\Services\Officers;

use PGI\Impact\PGDatabase\Interfaces\EntityWrappedInterface;
use PGI\Impact\PGIntl\Services\Translator;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use WC_Product as LocalWC_Product;
use WC_Product_Attribute as LocalWC_Product_Attribute;
use WC_Product_Variable as LocalWC_Product_Variable;
use Exception;
use PGI\Impact\PGTree\Interfaces\Officers\TreeContributionOfficerInterface;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGShop\Services\Managers\ProductManager;
use PGI\Impact\PGSystem\Components\Parameters;

/**
* Class TreeContributionOfficer
* @package PGWooTree\Services\Officers
*/
class TreeContributionOfficer implements TreeContributionOfficerInterface
{
    /** @var TreeContributionImageOfficer */
    protected $treeContributionImageOfficer;

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
        TreeContributionImageOfficer $treeContributionImageOfficer,
        ProductManager $productManager,
        Translator $translator,
        Parameters $parameters,
        Settings $settings,
        LoggerInterface $logger
    ) {
        $this->treeContributionImageOfficer = $treeContributionImageOfficer;
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

        $primary = $this->settings->get('tree_contribution_id');

        if (empty($primary)) {
            $primary = wc_get_product_id_by_sku($this->parameters['data.tree_contribution.reference']);
        }

        if (!empty($primary)) {
            $contribution = $this->productManager->getByPrimary($primary);

            if ($contribution !== null) {
                $result = $primary;
                $this->settings->set('tree_contribution_id', $primary);
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function isValid($contribution, ShopEntityInterface $shop)
    {
        $isActive = $this->isActive($contribution);
        $isNotEligibleToTaxes = $this->isNotEligibleToTaxes($contribution);
        $isImageInstalled = ($this->treeContributionImageOfficer->getContributionImageId($contribution) !== null);
        $hasAssociatedImage = $this->treeContributionImageOfficer->hasAssociatedImage($contribution);

        return ($isActive && $isNotEligibleToTaxes && $isImageInstalled && $hasAssociatedImage);
    }

    /**
     * @inheridoc
     */
    public function validate($contribution, ShopEntityInterface $shop)
    {
        $result = false;

        try {
            $this->logger->debug("Tree contribution product validation.");

            /** @var LocalWC_Product $localContribution */
            $localContribution = $contribution->getLocalEntity();

            if (!$this->isActive($contribution)) {
                $this->logger->debug("Update contribution status.");
                $localContribution->set_status('publish');
            }

            if (!$this->isNotEligibleToTaxes($contribution)) {
                $this->logger->debug("Disable taxes on the contribution product.");
                $localContribution->set_tax_status('none');
            }

            if (($this->treeContributionImageOfficer->getContributionImageId($contribution) === null)) {
                $this->treeContributionImageOfficer->install($contribution);
            }

            if (!$this->treeContributionImageOfficer->hasAssociatedImage($contribution)) {
                $this->treeContributionImageOfficer->associate($contribution);
            }

            $localContribution->save();

            $result = true;
        } catch (Exception $exception) {
            $this->logger->error('An error occurred during tree contribution product validation.');
        }

        return $result;
    }

    /**
     * @inheridoc
     */
    public function disable($contribution, ShopEntityInterface $shop)
    {
        try {
            $this->logger->debug('Disable tree contribution product.');

            /** @var LocalWC_Product $localContribution */
            $localContribution = $contribution->getLocalEntity();

            $localContribution->set_status('pending');
            $localContribution->save();

            return true;
        } catch (Exception $exception) {
            $this->logger->error('An error occurred while deactivating the tree contribution product.', $exception);
        }

        return false;
    }

    /**
     * @inheridoc
     * @throws Exception
     */
    public function create(ShopEntityInterface $shop)
    {
        $this->logger->notice("Creating tree contribution product.");

        /** @var ProductEntityInterface $contribution */
        $contribution = $this->createWrappedEntity();

        $this->insertLocalEntity($contribution->getLocalEntity());

        $this->treeContributionImageOfficer->install($contribution, $shop);

        $this->settings->set('tree_contribution_id', $contribution->id());

        return $contribution;
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
                'data.tree_contribution.name',
                'fr')
            );
            $localProduct->set_description($this->translator->get(
                'data.tree_contribution.description',
                'fr')
            );

            $localProduct->set_slug($this->parameters['data.tree_contribution.reference']);
            $localProduct->set_sku($this->parameters['data.tree_contribution.reference']);
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
            $this->logger->critical("An error occurred during local contribution product creation.", $exception);

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
     * @param ProductEntityInterface $contribution
     * @return bool
     */
    private function isActive(ProductEntityInterface $contribution)
    {
        return ($contribution->getLocalEntity()->get_status() === 'publish');
    }

    /**
     * @param ProductEntityInterface $contribution
     * @return bool
     */
    private function isNotEligibleToTaxes(ProductEntityInterface $contribution)
    {
        return ($contribution->getLocalEntity()->get_tax_status() === 'none');
    }
}