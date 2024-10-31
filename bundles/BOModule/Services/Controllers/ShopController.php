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

namespace PGI\Impact\BOModule\Services\Controllers;

use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\BOModule\Services\Handlers\MenuHandler;
use PGI\Impact\PGServer\Foundations\AbstractResponse;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;
use PGI\Impact\PGShop\Services\Managers\ShopManager;
use Exception;

/**
 * Class ShopController
 * @package BOModule\Services\Controllers
 */
class ShopController extends AbstractBackofficeController
{
    /** @var ShopHandler */
    private $shopHandler;

    /** @var ShopManager */
    private $shopManager;

    /** @var MenuHandler */
    private $menuHandler;

    public function __construct(
        ShopHandler $shopHandler,
        ShopManager $shopManager,
        MenuHandler $menuHandler
    ) {
        $this->shopHandler = $shopHandler;
        $this->shopManager = $shopManager;
        $this->menuHandler = $menuHandler;
    }

    /**
     * @return AbstractResponse
     * @throws Exception
     */
    public function setCurrentShopAction()
    {
        $shop = $this->getSelectedShop();

        $this->shopHandler->defineCurrentShop($shop);

        $url = $this->getRedirectUrl();

        return $this->redirect($url);
    }

    /**
     * @return ShopEntityInterface
     * @throws Exception
     */
    private function getSelectedShop()
    {
        $id_shop = $this->getRequest()->get('id');

        if ($id_shop === null) {
            throw new Exception("Shop primary not found.");
        }

        $shop = $this->shopManager->getByPrimary($id_shop);

        if ($shop === null) {
            throw new Exception("Shop #$id_shop not found.");
        }

        return $shop;
    }

    private function getRedirectUrl()
    {
        $selected = $this->getRequest()->get('selected');

        $action = $this->menuHandler->getDefaultAction();

        foreach ($this->menuHandler->getEntries() as $code => $entry) {
            if ($code === $selected) {
                $action = $entry['action'];
            }
        }

        return $this->getLinkHandler()->buildBackOfficeUrl($action);
    }
}
