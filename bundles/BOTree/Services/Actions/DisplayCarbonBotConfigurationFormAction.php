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

namespace PGI\Impact\BOTree\Services\Actions;

use PGI\Impact\PGForm\Services\Views\FormView;
use PGI\Impact\PGIntl\Services\Handlers\LocaleHandler;
use PGI\Impact\PGIntl\Services\Handlers\TranslationHandler;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Resources\ScriptFile as ScriptFileResourceComponent;
use PGI\Impact\PGServer\Components\Resources\StyleFile as StyleFileResourceComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use PGI\Impact\PGServer\Foundations\AbstractAction;
use PGI\Impact\PGSystem\Components\Parameters;
use PGI\Impact\PGSystem\Components\Parameters as ParametersComponent;
use PGI\Impact\PGView\Components\Box as BoxComponent;
use Exception;

/**
 * Class DisplayCarbonBotConfigurationFormAction
 * @package BOTree\Services\Actions
 */
class DisplayCarbonBotConfigurationFormAction extends AbstractAction
{
    /** @var TranslationHandler $translationHandler */
    private $translationHandler;

    /** @var LocaleHandler $localeHandler */
    private $localeHandler;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function process()
    {
        /** @var ParametersComponent $parameters */
        $parameters = $this->getParameters();

        $locale = $this->localeHandler->getLanguage();

        /** @var TemplateResponseComponent $output */
        $response = $this->buildTemplateResponse($parameters['data.carbon_bot.carbon_bot_preview'], array(
            'color' => $this->getSettings()->get("tree_bot_color"),
            'position' => $this->getSettings()->get("tree_bot_side"),
            'isDetailsActivated' => "true",
            'detailsUrl' => $this->getSettings()->get('tree_details_url'),
            'title' => json_encode($this->translationHandler->translate('message_carbon_footprint')),
            'description' => json_encode($this->translationHandler->translate('message_find_out_more')),
            'offset' => json_encode($this->translationHandler->translate('message_carbon_offset')),
            'isTreeTestModeActivated' => $this->getSettings()->get('tree_test_mode'),
            'locale' => $locale
        ))->addData('form', $this->buildSettingsFormView());

        $response->addResource(new StyleFileResourceComponent('/css/tree-bot-main.css'));
        $response->addResource(new ScriptFileResourceComponent($parameters['data.carbon_bot.carbon_bot_preview_js']));

        return $response;
    }

    /**
     * @return BoxComponent
     * @throws Exception
     */
    protected function buildSettingsFormView()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();

        /** @var ParametersComponent $parameters */
        $parameters = $this->getParameters();

        $form_name = 'tree_bot';

        $keys = array_keys($parameters["form.definitions.$form_name.fields"]);

        $values = $settings->getArray($keys);

        /** @var FormView $view */
        $view = $this->buildForm($form_name, $values)->buildView();

        $url = $this->getLinkHandler()->buildBackOfficeUrl('backoffice.tree_bot_form.save');

        $view->setAction($url);

        return new BoxComponent($view);
    }

    /**
     * @param TranslationHandler $translationHandler
     */
    public function setTranslationHandler($translationHandler)
    {
        $this->translationHandler = $translationHandler;
    }

    /**
     * @param LocaleHandler $localeHandler
     */
    public function setLocaleHandler($localeHandler)
    {
        $this->localeHandler = $localeHandler;
    }
}
