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

use PGI\Impact\APITree\Services\Facades\ApiFacade;
use PGI\Impact\PGFramework\Services\Handlers\CookieHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;
use DateTime;
use Exception;

/**
 * Class TreeFootprintIdHandler
 * @package PGTree\Services\Handlers
 */
class TreeFootprintIdHandler
{
    const FOOTPRINT_ID_COOKIE_NAME = 'pgFootprintId';

    /** @var CookieHandler */
    private $cookieHandler;

    /** @var ShopHandler */
    private $shopHandler;

    /** @var Settings */
    private $settings;

    /** @var LoggerInterface */
    private $logger;

    /** @var ApiFacade */
    private $treeAPIFacade;

    /** @var TreeFootprintTokenHandler */
    private $treeFootprintTokenHandler;

    public function __construct(
        CookieHandler $cookieHandler,
        ShopHandler $shopHandler,
        Settings $settings,
        LoggerInterface $logger,
        ApiFacade $treeAPIFacade,
        TreeFootprintTokenHandler $treeFootprintTokenHandler
    ) {
        $this->cookieHandler = $cookieHandler;
        $this->shopHandler = $shopHandler;
        $this->settings = $settings;
        $this->logger = $logger;
        $this->treeAPIFacade = $treeAPIFacade;
        $this->treeFootprintTokenHandler = $treeFootprintTokenHandler;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function createFootprintId()
    {
        $id = $this->generateUniqueFootprintId();

        $this->logger->debug("Create '" . self::FOOTPRINT_ID_COOKIE_NAME . "' cookie.");
        $this->cookieHandler->set(self::FOOTPRINT_ID_COOKIE_NAME, null);

        $this->treeFootprintTokenHandler->resetToken();

        try {
            $this->treeAPIFacade->createEmptyFootprint($id);
            $this->cookieHandler->set(self::FOOTPRINT_ID_COOKIE_NAME, $id);
        } catch (Exception $exception) {
            $this->logger->error("Unable to create empty footprint : " . $exception->getMessage(), $exception);
        }

        return $id;
    }

    /**
     * @throws Exception
     */
    public function resetFootprintId()
    {
        $this->logger->debug("Reset '" . self::FOOTPRINT_ID_COOKIE_NAME . "' cookie.");
        $this->cookieHandler->set(self::FOOTPRINT_ID_COOKIE_NAME, null);

        $this->treeFootprintTokenHandler->resetToken();
    }

    /**
     * @return mixed|null
     * @throws Exception
     */
    public function getFootprintId()
    {
        if (!$this->cookieHandler->has(self::FOOTPRINT_ID_COOKIE_NAME) || $this->cookieHandler->get(self::FOOTPRINT_ID_COOKIE_NAME) === "") {
            $this->logger->warning("Footprint cookie not found.");
            $id = $this->createFootprintId();
            $this->treeFootprintTokenHandler->createToken($id);
        } else {
            $id = $this->cookieHandler->get(self::FOOTPRINT_ID_COOKIE_NAME);
        }

        return $id;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generateUniqueFootprintId()
    {
        $shopId = $this->shopHandler->getCurrentShopPrimary();
        $clientId = $this->settings->get('tree_client_id');
        $footprintIdToHash = $this->getTimestampAsAString() . $shopId . $clientId . mt_rand(0, PHP_INT_MAX);

        return hash('sha256', $footprintIdToHash);
    }
    /**
     * @throws Exception
     * @return string
     */
    private function getTimestampAsAString()
    {
        $datetime = new DateTime();
        return (string) $datetime->getTimestamp();
    }
}
