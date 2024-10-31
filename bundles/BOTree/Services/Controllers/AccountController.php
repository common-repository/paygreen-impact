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
use PGI\Impact\PGForm\Interfaces\FormInterface;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use PGI\Impact\PGTree\Services\Handlers\TreeAuthenticationHandler;
use PGI\Impact\PGView\Components\Box as BoxComponent;
use Exception;

/**
 * Class AccountController
 * @package BOTree\Services\Controllers
 */
class AccountController extends AbstractBackofficeController
{
    /** @var TreeAuthenticationHandler */
    private $treeAuthenticationHandler;

    public function setTreeAuthenticationHandler(TreeAuthenticationHandler $treeAuthenticationHandler)
    {
        $this->treeAuthenticationHandler = $treeAuthenticationHandler;
    }

    /**
     * @throws Exception
     */
    public function connectAction()
    {
        /** @var Settings $settings */
        $settings = $this->getSettings();

        $client_id = $settings->get('tree_client_id');
        if($this->treeAuthenticationHandler->activateClimate($client_id)) {
            $this->success('actions.tree_authentication.save.result.success');
        }
        else {
            $this->failure('actions.tree_authentication.save.result.failure');
        }


        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.home.display'));
    }
}
