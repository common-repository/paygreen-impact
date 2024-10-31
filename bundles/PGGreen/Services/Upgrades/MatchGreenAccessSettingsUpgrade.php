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

namespace PGI\Impact\PGGreen\Services\Upgrades;

use Exception;
use PGI\Impact\PGModule\Components\UpgradeStage as UpgradeComponent;
use PGI\Impact\PGModule\Interfaces\Entities\SettingEntityInterface;
use PGI\Impact\PGModule\Interfaces\UpgradeInterface;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Managers\SettingManager;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;

/**
 * Class MatchGreenAccessSettingsUpgrade
 * @package PGGreen\Services\Upgrades
 */
class MatchGreenAccessSettingsUpgrade implements UpgradeInterface
{
    /** @var SettingManager */
    private $settingManager;

    /** @var ShopHandler */
    private $shopHandler;

    /** @var LoggerInterface */
    private $logger;

    private $bin;

    public function __construct(
        SettingManager $settingManager,
        ShopHandler $shopHandler,
        LoggerInterface $logger
    ) {
        $this->settingManager = $settingManager;
        $this->shopHandler = $shopHandler;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function apply(UpgradeComponent $upgradeStage)
    {
        // Thrashing unused arguments
        $this->bin = $upgradeStage;

        $treeSettings = array(
            'tree_access_token',
            'tree_access_token_validity',
            'tree_refresh_token',
            'tree_refresh_token_validity',
            'tree_client_id',
            'tree_client_username'
        );

        $charitySettings = array(
            'charity_access_token',
            'charity_access_token_validity',
            'charity_refresh_token',
            'charity_refresh_token_validity',
            'charity_client_id',
            'charity_client_username'
        );

        /** @var ShopEntityInterface[] $shops */
        $shops = $this->shopHandler->getShopManager()->getAll();

        foreach ($shops as $shop) {

            $resetAllSettings = false;
            $climateAccessValid = true;
            $charityAccessValid = true;

            $climateActivated = false;
            $charityActivated = false;

            $treeActivationSetting = $this->settingManager->getByNameAndShop('tree_activation', $shop);
            if ($treeActivationSetting !== null && $treeActivationSetting->getValue() === "1") {
                $this->logger->debug("Tree activated for shop '{$shop->id()}'.");
                $climateActivated = true;
            }

            $charityActivationSetting = $this->settingManager->getByNameAndShop('charity_activation', $shop);
            if ($charityActivationSetting !== null && $charityActivationSetting->getValue() === "1") {
                $this->logger->debug("Charity activated for shop '{$shop->id()}'.");
                $charityActivated = true;
            }

            foreach ($treeSettings as $treeSettingName) {
                /** @var SettingEntityInterface|null $setting */
                $setting = $this->settingManager->getByNameAndShop($treeSettingName, $shop);

                if ($setting === null || $setting->getValue() === "") {
                    $climateAccessValid = false;
                    $this->logger->debug("Tree setting '$treeSettingName' not set for shop '{$shop->id()}'.");
                }
            }

            foreach ($charitySettings as $charitySettingName) {
                /** @var SettingEntityInterface|null $setting */
                $setting = $this->settingManager->getByNameAndShop($charitySettingName, $shop);

                if ($setting === null || $setting->getValue() === "") {
                    $charityAccessValid = false;
                    $this->logger->debug("Charity setting '$charitySettingName' not set for shop '{$shop->id()}'.");
                }
            }

            if($climateAccessValid && $charityAccessValid && ($climateActivated || $charityActivated)) {
                $climateClientId = $this->settingManager->getByNameAndShop('tree_client_id', $shop);
                $charityClientId = $this->settingManager->getByNameAndShop('charity_client_id', $shop);

                if($climateClientId->getValue() !== $charityClientId->getValue() ) {
                    $this->logger->debug("Charity and Climate connected with non matching client id.");
                    $resetAllSettings = true;
                }
            }
            else if($climateAccessValid && $climateActivated) {
                $this->logger->debug("Copy Climate informations into Charity.");
                $this->resetSetting("charity_activation",$shop);
                $this->copySettings("tree","charity",$shop);
            }
            else if($charityAccessValid && $charityActivated) {
                $this->logger->debug("Copy Charity informations into Climate.");
                $this->resetSetting("tree_activation",$shop);
                $this->copySettings("charity","tree",$shop);
            } else {
                $resetAllSettings = true;
            }

            if ($resetAllSettings) {
                $this->resetSetting("tree_activation",$shop);
                $this->resetSetting("charity_activation",$shop);

                $settings = array_merge($treeSettings, $charitySettings);

                foreach ($settings as $name) {
                    /** @var SettingEntityInterface|null $setting */
                    $setting = $this->settingManager->getByNameAndShop($name, $shop);

                    if ($setting !== null) {
                        $this->settingManager->delete($setting);
                    } else {
                        $this->logger->debug("Setting '$name' not found for shop '{$shop->id()}'.");
                    }
                }
            }
        }
    }


    /**
     * @param string $copy
     * @param string $paste
     * @param ShopEntityInterface $shop
     * @throws Exception
     */
    private function copySettings($copy, $paste, $shop) {

        $settings = array(
            '_access_token',
            '_access_token_validity',
            '_refresh_token',
            '_refresh_token_validity',
            '_client_id',
            '_client_username'
        );

        foreach ($settings as $settingName) {
            $settingNameToCopy = $copy.$settingName;
            $settingNameToUpdate = $paste.$settingName;
            /** @var SettingEntityInterface|null $settingToCopy */
            $settingToCopy = $this->settingManager->getByNameAndShop($settingNameToCopy, $shop);
            $this->logger->debug("Copy setting '$settingNameToCopy' into '$settingNameToUpdate' for shop '{$shop->id()}'.");

            if ($settingToCopy !== null && $settingToCopy->getValue() !== "") {
                $settingToUpdate = $this->settingManager->getByNameAndShop($settingNameToUpdate, $shop);
                if($settingToUpdate !== null) {
                    $settingToUpdate->setValue($settingToCopy->getValue());
                    $this->settingManager->update($settingToUpdate);
                } else {
                    $this->settingManager->insert($settingNameToUpdate, $settingToCopy->getValue(),$shop);
                }
            } else {
                $this->logger->debug("Cannot copy setting '$settingNameToCopy', not found for shop '{$shop->id()}'.");
            }
        }
    }

    /**
     * @param string $settingName
     * @param ShopEntityInterface $shop
     * @throws Exception
     */
    private function resetSetting($settingName, $shop) {
        $setting = $this->settingManager->getByNameAndShop($settingName, $shop);
        if ($setting !== null) {
            $setting->setValue(0);
            $this->settingManager->update($setting);
        }
    }
}
