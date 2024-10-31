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

namespace PGI\Impact\PGTree\Services\Handlers;

use Exception;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;
use PGI\Impact\PGShop\Services\Managers\ProductManager;
use PGI\Impact\PGTree\Interfaces\Officers\TreeContributionOfficerInterface;

/**
 * Class TreeContributionHandler
 * @package PGTree\Services\Handlers;
 */
class TreeContributionHandler
{
    /** @var ProductManager */
    private $productManager;

    /** @var TreeContributionOfficerInterface */
    private $treeContributionOfficer;

    /** @var ShopHandler */
    private $shopHandler;

    public function __construct(
        ProductManager                   $productManager,
        TreeContributionOfficerInterface $treeContributionOfficer,
        ShopHandler                      $shopHandler
    ) {
        $this->productManager = $productManager;
        $this->treeContributionOfficer = $treeContributionOfficer;
        $this->shopHandler = $shopHandler;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getPrimary()
    {
        if (!$this->exist()) {
            throw new Exception('Contribution primary not found.');
        }

        return $this->treeContributionOfficer->getPrimary($this->shopHandler->getCurrentShop());
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function exist()
    {
        $primary = $this->treeContributionOfficer->getPrimary($this->shopHandler->getCurrentShop());

        return (!empty($primary));
    }

    /**
     * @return ProductEntityInterface
     * @throws Exception
     */
    public function get()
    {
        $id = $this->getPrimary();

        return $this->productManager->getByPrimary($id);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isValid()
    {
        $result = false;

        $contribution = $this->get();

        if ($contribution !== null) {
            $result = $this->treeContributionOfficer->isValid(
                $contribution,
                $this->shopHandler->getCurrentShop()
            );
        }

        return $result;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function install()
    {
        if ($this->exist() && ($this->get() !== null)) {
            if ($this->isValid()) {
                throw new Exception('Valid contribution product already installed.');
            } else {
                $contribution = $this->get();
                $this->treeContributionOfficer->validate($contribution, $this->shopHandler->getCurrentShop());
            }
        } else {
            $this->treeContributionOfficer->create($this->shopHandler->getCurrentShop());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function uninstall()
    {
        $contribution = $this->get();
        return $this->treeContributionOfficer->disable($contribution, $this->shopHandler->getCurrentShop());
    }
}
