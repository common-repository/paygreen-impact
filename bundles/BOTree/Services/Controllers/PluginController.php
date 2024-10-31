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

namespace PGI\Impact\BOTree\Services\Controllers;

use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use PGI\Impact\PGServer\Components\Resources\StyleFile as StyleFileResourceComponent;
use PGI\Impact\PGTree\Services\Handlers\TreeAccountHandler;
use PGI\Impact\PGTree\Services\Handlers\TreeAuthenticationHandler;
use Exception;

/**
 * Class PluginController
 * @package BOTree\Services\Controllers
 */
class PluginController extends AbstractBackofficeController
{
    /** @var TreeAuthenticationHandler */
    private $treeAuthenticationHandler;

    /** @var TreeAccountHandler */
    private $treeAccountHandler;

    public function setTreeAuthenticationHandler(TreeAuthenticationHandler $treeAuthenticationHandler)
    {
        $this->treeAuthenticationHandler = $treeAuthenticationHandler;
    }

    public function setTreeAccountHandler(TreeAccountHandler $treeAccountHandler)
    {
        $this->treeAccountHandler = $treeAccountHandler;
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
        $addressNeeded = false;
        $description = 'blocks.tree_mode.test';

        $isTreeActivated = $settings->get('tree_activation');

        if ($this->treeAuthenticationHandler->isConnected()) {
            $isConnected = true;

            $infos['is_test_mode_activated'] = $settings->get('tree_test_mode');
            $infos['is_test_mode_expired'] = $this->treeAccountHandler->isTestModeExpired();
            $infos['is_mandate_signed'] = $this->treeAccountHandler->isMandateSigned();
            $addressNeeded = $this->treeAccountHandler->isAddressNeeded();
            if ($settings->get('tree_test_mode') === false) {
                $description = 'blocks.tree_mode.prod';
            }
        }

        return $this->buildTemplateResponse('tree/block-tree')
            ->addData('description', $description)
            ->addData('connected', $isConnected)
            ->addData('treeActivated', $isTreeActivated)
            ->addData('treeKitInfos', $infos)
            ->addData('addressNeeded', $addressNeeded)
            ->addResource(new StyleFileResourceComponent('/css/tree-home-block.css'))
        ;
    }

    /**
     * @return RedirectionResponseComponent
     * @throws Exception
     */
    public function treeTestModeActivationAction()
    {
        $settings = $this->getSettings();

        $treeTestMode = !$settings->get('tree_test_mode');

        $settings->set('tree_test_mode', $treeTestMode);

        if ($treeTestMode) {
            $this->success('actions.tree_mode.toggle.result.test');
        } else {
            $this->success('actions.tree_mode.toggle.result.prod');
        }

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.home.display'));
    }
}
