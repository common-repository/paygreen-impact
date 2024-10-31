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

namespace PGI\Impact\BOCharity\Services\Controllers;

use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGCharity\Services\Handlers\CharityAccountHandler;
use PGI\Impact\PGCharity\Services\Handlers\CharityAuthenticationHandler;
use PGI\Impact\PGServer\Components\Resources\StyleFile as StyleFileResourceComponent;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use Exception;

/**
 * Class PluginController
 * @package BOCharity\Services\Controllers
 */
class PluginController extends AbstractBackofficeController
{
    /** @var CharityAuthenticationHandler */
    private $charityAuthenticationHandler;

    /** @var CharityAccountHandler */
    private $charityAccountHandler;

    public function setCharityAccountHandler(CharityAccountHandler $charityAccountHandler)
    {
        $this->charityAccountHandler = $charityAccountHandler;
    }

    public function setCharityAuthenticationHandler(CharityAuthenticationHandler $charityAuthenticationHandler)
    {
        $this->charityAuthenticationHandler = $charityAuthenticationHandler;
    }

    /**
     * @return TemplateResponseComponent
     * @throws Exception
     */
    public function displayAction()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();

        $infos = array();
        $isConnected = false;
        $description = 'blocks.charity_mode.test';

        $isCharityActivated = $settings->get('charity_activation');

        if ($this->charityAuthenticationHandler->isConnected()) {
            $isConnected = true;

            $infos['is_test_mode_activated'] = $settings->get('charity_test_mode');
            $infos['is_test_mode_expired'] = $this->charityAccountHandler->isTestModeExpired();
            $infos['is_mandate_signed'] = $this->charityAccountHandler->isMandateSigned();
            if ($settings->get('charity_test_mode') === false) {
                $description = 'blocks.charity_mode.prod';
            }
        }

        return $this->buildTemplateResponse('charity/block-charity')
            ->addData('description', $description)
            ->addData('connected', $isConnected)
            ->addData('charityActivated', $isCharityActivated)
            ->addData('charityKitInfos', $infos)
            ->addResource(new StyleFileResourceComponent('/css/charity-home-block.css'))
            ;
    }

    /**
     * @return RedirectionResponseComponent
     * @throws Exception
     */
    public function charityTestModeActivationAction()
    {
        $settings = $this->getSettings();

        $charityTestMode = !$settings->get('charity_test_mode');

        $settings->set('charity_test_mode', $charityTestMode);

        if ($charityTestMode) {
            $this->success('actions.charity_mode.toggle.result.test');
        } else {
            $this->success('actions.charity_mode.toggle.result.prod');
        }

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.home.display'));
    }
}
