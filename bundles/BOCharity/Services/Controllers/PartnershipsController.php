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

use PGI\Impact\PGServer\Components\Resources\Data as DataResourceComponent;
use PGI\Impact\PGServer\Components\Resources\ScriptFile as ScriptFileResourceComponent;
use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGCharity\Services\Handlers\CharityPartnershipHandler;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use PGI\Impact\PGServer\Components\Responses\PaygreenModule as PaygreenModuleResponseComponent;
use PGI\Impact\PGClient\Exceptions\Response as ResponseException;
use Exception;
use PGI\Impact\PGServer\Foundations\AbstractResponse;

/**
 * Class PartnershipsController
 * @package BOCharity\Services\Controllers
 */
class PartnershipsController extends AbstractBackofficeController
{
    /** @var CharityPartnershipHandler */
    private $charityPartnershipHandler;

    public function setCharityPartnershipHandler(CharityPartnershipHandler $charityPartnershipHandler)
    {
        $this->charityPartnershipHandler = $charityPartnershipHandler;
    }

    /**
     * @return TemplateResponseComponent
     * @throws Exception
     */
    public function displayListAction()
    {
        $response = $this->buildTemplateResponse('charity_partnerships/block-partnerships-list', array(
            'partnerships' => $this->charityPartnershipHandler->getPartnerships()
        ));

        $response->addResource(new DataResourceComponent(array(
            'paygreen_update_elements_positions_url' => $this->getLinkHandler()->buildBackOfficeUrl(
                'backoffice.charity_partnerships.update_positions'
            )
        )));

        $response->addResource(new ScriptFileResourceComponent('/js/page-charity-partnerships-dragndrop.js'));

        return $response;
    }

    /**
     * @return AbstractResponse
     * @throws ResponseException
     * @throws Exception
     */
    public function updatePartnershipsPositionsAction()
    {
        $partnershipsPositions = array();

        $i = 1;

        foreach ($this->getRequest()->getAll() as $partnershipPosition => $partnershipId) {
            if ($partnershipPosition === $i) {
                $partnershipsPositions[$i] = $partnershipId;
            }

            $i++;
        }

        $this->getSettings()->set('charity_partnerships_positions', $partnershipsPositions);

        $response = new PaygreenModuleResponseComponent($this->getRequest());

        return $response->validate();
    }

    /**
     * @return RedirectionResponseComponent
     * @throws Exception
     */
    public function refreshPartnershipsAction()
    {
        $this->charityPartnershipHandler->refreshPartnerships();

        $this->success('actions.charity_partnerships.refresh.result.success');

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.charity_partnerships.display'));
    }

}
