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

namespace PGI\Impact\FOTree\Services\OutputBuilders;

use PGI\Impact\PGIntl\Services\Handlers\LocaleHandler;
use PGI\Impact\PGIntl\Services\Handlers\TranslationHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Components\Output as OutputComponent;
use PGI\Impact\PGModule\Foundations\AbstractOutputBuilder;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Resources\Data as DataResourceComponent;
use PGI\Impact\PGServer\Components\Resources\ScriptFile as ScriptFileResourceComponent;
use PGI\Impact\PGServer\Components\Resources\StyleFile as StyleFileResourceComponent;
use PGI\Impact\PGServer\Services\Handlers\LinkHandler;
use PGI\Impact\PGShop\Services\Managers\CartManager;
use PGI\Impact\PGSystem\Components\Parameters;
use PGI\Impact\PGTree\Services\Handlers\TreeAccountHandler;
use PGI\Impact\PGTree\Services\Handlers\TreeHandler;

/**
 * Class CarbonBotOutputBuilder
 * @package FOTree\Services\OutputBuilders
 */
class CarbonBotOutputBuilder extends AbstractOutputBuilder
{
    /** @var Settings */
    private $settings;

    /** @var CartManager */
    private $cartManager;

    /** @var TreeAccountHandler */
    private $treeAccountHandler;

    /** @var TranslationHandler */
    private $translationHandler;

    /** @var LinkHandler */
    private $linkHandler;

    /** @var LoggerInterface */
    private $logger;

    /** @var Parameters */
    private $parameters;

    /**
     * @var LocaleHandler
     */
    private $localeHandler;

    /**
     * @var TreeHandler
     */
    private $treeHandler;

    public function __construct(
        Settings $settings,
        TreeAccountHandler $treeAccountHandler,
        CartManager $cartManager,
        TranslationHandler $translationHandler,
        LinkHandler $linkHandler,
        LoggerInterface $logger,
        Parameters $parameters,
        LocaleHandler $localeHandler,
        TreeHandler $treeHandler
    ) {
        parent::__construct();

        $this->settings = $settings;
        $this->cartManager = $cartManager;
        $this->treeAccountHandler = $treeAccountHandler;
        $this->translationHandler = $translationHandler;
        $this->linkHandler = $linkHandler;
        $this->logger = $logger;
        $this->parameters = $parameters;
        $this->localeHandler = $localeHandler;
        $this->treeHandler = $treeHandler;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function build(array $data = array())
    {
        /** @var object $user */
        $user = $this->treeAccountHandler->getAccountData();

        /** @var OutputComponent $output */
        $output = new OutputComponent();

        if ($this->cartManager->getCurrent()) {
            $cartPrice = $this->cartManager->getCurrent()->getTotalCost();
        }

        $server = $this->settings->get('tree_api_server');
        $url = $this->parameters["urls.climatekit.$server"];

        if (!$url) {
            $this->logger->error("Invalid url for climatekit api server. Use default value.");

            $server = $this->settings->getDefault('tree_api_server');
            $url = $this->parameters["urls.climatekit.$server"];
        }

        $testMode = "false";
        if ($this->settings->get("tree_test_mode")) {
            $testMode = "true";
        }

        $showOnMobile = "true";
        $carbonBotActivated = "true";

        switch ($this->settings->get("tree_bot_displayed")) {
            case 1:
                $showOnMobile = "false";
                break;
            case 2:
                $carbonBotActivated = "false";
        }

        $contributionActivated = "false";
        if ($this->settings->get("tree_user_contribution")) {
            $contributionActivated = "true";
        }

        $hasContribution = "false";
        if ($this->treeHandler->hasContribution()) {
            $hasContribution = "true";
        }

        $locale = $this->localeHandler->getLanguage();


        $output->addResource(new DataResourceComponent(array(
            'paygreen_tree_climatebot_locale' => $locale,
            'paygreen_tree_climatebot_api_url' => $url,
            'paygreen_tree_climatebot_name' => $user->organisationName,
            'paygreen_tree_climatebot_color' => $this->settings->get("tree_bot_color"),
            'paygreen_tree_climatebot_position' => $this->settings->get("tree_bot_side"),
            'paygreen_tree_climatebot_url' => $this->settings->get("tree_details_url"),
            'paygreen_tree_climatebot_mobile' => $showOnMobile,
            'paygreen_tree_climatebot_test_mode' => $testMode,
            'paygreen_tree_climatebot_description' => $this->translationHandler->translate('message_find_out_more'),
            'paygreen_tree_climatebot_title' => $this->translationHandler->translate('message_carbon_footprint'),
            'paygreen_tree_climatebot_offset' => $this->translationHandler->translate('message_carbon_offset'),
            'paygreen_create_footprint_url' => $this->linkHandler->buildFrontOfficeUrl('front.tree.create_footprint'),
            'paygreen_add_contribution_action' => $this->linkHandler->buildFrontOfficeUrl('front.tree.save_contribution'),
            'paygreen_remove_contribution_action' => $this->linkHandler->buildFrontOfficeUrl('front.tree.cancel_contribution'),
            'paygreen_has_contribution_in_cart' => $hasContribution,
            'paygreen_carbon_bot_activated' => $carbonBotActivated,
            'paygreen_contribution_activated' => $contributionActivated
        )));

        $output->addResource(new ScriptFileResourceComponent($this->parameters["data.carbon_bot.carbon_bot_front"]));
        $output->addResource(new StyleFileResourceComponent('/css/tree-frontoffice.css'));

        return $output;
    }
}
