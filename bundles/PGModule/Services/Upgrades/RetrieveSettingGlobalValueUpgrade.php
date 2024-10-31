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

namespace PGI\Impact\PGModule\Services\Upgrades;

use Exception;
use PGI\Impact\PGModule\Components\UpgradeStage as UpgradeComponent;
use PGI\Impact\PGModule\Interfaces\Entities\SettingEntityInterface;
use PGI\Impact\PGModule\Interfaces\UpgradeInterface;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Managers\SettingManager;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use PGI\Impact\PGShop\Services\Managers\ShopManager;

/**
 * Class RetrieveSettingValueUpgrade
 * @package PGModule\Services\Upgrades
 */
class RetrieveSettingGlobalValueUpgrade implements UpgradeInterface
{
    /** @var SettingManager */
    private $settingManager;

    /** @var ShopManager */
    private $shopManager;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        SettingManager $settingManager,
        ShopManager $shopManager,
        LoggerInterface $logger
    ) {
        $this->settingManager = $settingManager;
        $this->shopManager = $shopManager;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function apply(UpgradeComponent $upgradeStage)
    {
        $key_to_update = $upgradeStage->getConfig('key_to_update');
        $key_global_setting = $upgradeStage->getConfig('key_global_setting');

        if ($this->settingManager->hasByShop($key_global_setting)) {
            $global_setting = $this->settingManager->getByNameAndShop($key_global_setting);
            $this->settingManager->delete($global_setting);

            foreach ($this->shopManager->getAll() as $shop) {
                $this->applyForShop($key_to_update, $global_setting, $shop);
            }
        } else {
            $this->logger->notice("'$key_global_setting' has never been defined. Non change needed");
        }
    }

    /**
     * @param string $key_to_update
     * @param SettingEntityInterface $global_setting
     * @param ShopEntityInterface $shop
     * @throws Exception
     */
    public function applyForShop($key_to_update, SettingEntityInterface $global_setting, ShopEntityInterface $shop)
    {
        $global_setting_value = $global_setting->getValue();

        if ($this->settingManager->hasByShop($key_to_update, $shop)) {
            $setting = $this->settingManager->getByNameAndShop($key_to_update, $shop);
            $setting->setValue($global_setting_value);

            $this->settingManager->update($setting);
        } else {
            $this->settingManager->insert($key_to_update, $global_setting_value, $shop);
        }
    }
}
