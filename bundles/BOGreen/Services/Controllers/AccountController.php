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

namespace PGI\Impact\BOGreen\Services\Controllers;

use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGCharity\Services\Handlers\CharityAuthenticationHandler;
use PGI\Impact\PGForm\Interfaces\FormInterface;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use PGI\Impact\PGTree\Services\Handlers\TreeAuthenticationHandler;
use PGI\Impact\PGView\Components\Box as BoxComponent;
use Exception;

/**
 * Class AccountController
 * @package BOGreen\Services\Controllers
 */
class AccountController extends AbstractBackofficeController
{
    /** @var TreeAuthenticationHandler */
    private $treeAuthenticationHandler;

    /** @var CharityAuthenticationHandler */
    private $charityAuthenticationHandler;

    public function setCharityAuthenticationHandler(CharityAuthenticationHandler $charityAuthenticationHandler)
    {
        $this->charityAuthenticationHandler = $charityAuthenticationHandler;
    }

    public function setTreeAuthenticationHandler(TreeAuthenticationHandler $treeAuthenticationHandler)
    {
        $this->treeAuthenticationHandler = $treeAuthenticationHandler;
    }

    /**
     * @return BoxComponent
     * @throws Exception
     */
    protected function buildAuthenticationFormView()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();

        $action = $this->getLinkHandler()->buildBackOfficeUrl('backoffice.green_account.connect');

        $view = $this->buildForm('green_authentication')
            ->buildView()
            ->setAction($action)
        ;

        return new BoxComponent($view);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function connectAction()
    {
        /** @var FormInterface $form */
        $form = $this->buildForm('green_authentication', $this->getRequest()->getAll());

        if ($form->isValid()) {
            $clientId = $form->getValue('client_id');
            $login = $form->getValue('login');
            $password = $form->getValue('password');

            $isTreeConnected = $this->treeAuthenticationHandler->connect(
                $clientId,
                $login,
                $password
            );

            $isCharityConnected = $this->charityAuthenticationHandler->connect(
                $clientId,
                $login,
                $password
            );

            if ($isTreeConnected && $isCharityConnected) {
                $climateActivated = $this->treeAuthenticationHandler->activateClimate($clientId);
                $charityActivated =$this->charityAuthenticationHandler->activateCharity($clientId);
                if($climateActivated || $charityActivated) {
                    $this->success('actions.green_authentication.save.result.success');
                } else {
                    $this->treeAuthenticationHandler->disconnect();
                    $this->charityAuthenticationHandler->disconnect();
                    $this->failure('actions.green_authentication.save.result.warning');
                }
            } else {
                $this->failure('actions.green_authentication.save.result.failure');
            }
        } else {
            $this->failure('actions.green_authentication.save.result.invalid');
        }

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.home.display'));
    }

    /**
     * @return TemplateResponseComponent
     * @throws Exception
     */
    public function displayAccountInfosAction()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();

        $infos = null;

        if ($this->treeAuthenticationHandler->isConnected() && $this->charityAuthenticationHandler->isConnected()) {
            $client_id = $settings->get('tree_client_id');
            $username = $settings->get('tree_client_username');
            $infos = array(
                'blocks.green_account_infos.form.client_id' => $client_id,
                'blocks.green_account_infos.form.username' => $username
            );
        }

        return $this->buildTemplateResponse('green_account/block-infos')
            ->addData('infos', $infos)
        ;
    }

    public function displayAccountLoginAction()
    {
        return $this->buildTemplateResponse('green_account/block-login')
            ->addData('form', $this->buildAuthenticationFormView())
        ;
    }

    /**
     * @return RedirectionResponseComponent
     * @throws Exception
     */
    public function disconnectTreeAction()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();
        $settings->set('tree_activation',false);

        if($settings->get('charity_activation') === false) {
            $this->charityAuthenticationHandler->disconnect();
            $this->treeAuthenticationHandler->disconnect();
            $this->success('actions.green_authentication.reset.result.success');
        }
        else {
            $this->success('actions.tree_authentication.reset.result.success');
        }

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.home.display'));
    }

    /**
     * @return RedirectionResponseComponent
     * @throws Exception
     */
    public function disconnectCharityAction()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();
        $settings->set('charity_activation',false);

        if($settings->get('tree_activation') === false) {
            $this->charityAuthenticationHandler->disconnect();
            $this->treeAuthenticationHandler->disconnect();
            $this->success('actions.green_authentication.reset.result.success');
        }
        else {
            $this->success('actions.charity_authentication.reset.result.success');
        }

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.home.display'));
    }
}
