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

namespace PGI\Impact\FOTree\Services\Controllers;

use PGI\Impact\APITree\Services\Facades\ApiFacade;
use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGTree\Services\Handlers\TreeHandler;
use PGI\Impact\PGServer\Components\Responses\Forward as ForwardResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use Exception;

/**
 * Class UserContributionController
 * @package FOTree\Services\Controllers
 */
class UserContributionController extends AbstractBackofficeController
{
    /** @var TreeHandler */
    private $treeHandler;

    /** @var ApiFacade */
    private $apiFacade;

    public function __construct(
        TreeHandler $treeHandler,
        ApiFacade $apiFacade
    ) {
        $this->treeHandler = $treeHandler;
        $this->apiFacade = $apiFacade;
    }

    /**
     * @return RedirectionResponseComponent|ForwardResponseComponent
     * @throws Exception
     */
    public function saveContributionAction()
    {
        $requestArguments = $this->getRequest()->getAll();
        $contributionAmount = 0;
        $footprintId = 0;

        if (isset($requestArguments[0]) && isset($requestArguments[1])) {
            $contributionAmount = (float) $requestArguments[0]/100;
            $footprintId = $requestArguments[1];
        } else {
            $this->getLogger()->warning("Contribution amount is not set correctly.");
        }

        if ($contributionAmount == 0) {
            $contributionAmount = 0.01;
            $this->getLogger()->warning("The contribution is equal to zero, the value is fixed at 0.01.");
        }

        $this->getLogger()->debug("Adding Climate Contribution : ", $contributionAmount);

        try {
            if ($this->reserveCarbon($footprintId) && $this->treeHandler->addContribution($contributionAmount)) {
                $response = $this->redirect($this->getLinkHandler()->buildLocalUrl('checkout'));
            } else {
                $response = $this->forward('displayNotification@front.notification', array(
                    'title' => 'actions.contribution.save.result.failure.title',
                    'message' => 'actions.contribution.save.result.failure.message',
                    'url' => array(
                        'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                        'text' => 'actions.contribution.save.result.failure.link',
                    )
                ));
            }
        } catch (Exception $exception) {
            $this->getLogger()->error(
                "An error occurred while saving contribution : " . $exception->getMessage(),
                $exception
            );

            $response = $this->forward('displayNotification@front.notification', array(
                'title' => 'actions.contribution.save.result.error.title',
                'message' => 'actions.contribution.save.result.error.message',
                'url' => array(
                    'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                    'text' => 'actions.contribution.save.result.error.link',
                )
            ));
        }

        return $response;
    }

    public function cancelContributionAction()
    {
        $this->getLogger()->debug("Cancel Climate Contribution");

        try {
            if ($this->treeHandler->removeContribution()) {
                $response = $this->redirect($this->getLinkHandler()->buildLocalUrl('checkout'));
            } else {
                $response = $this->forward('displayNotification@front.notification', array(
                    'title' => 'actions.contribution.cancel.result.failure.title',
                    'message' => 'actions.contribution.cancel.result.failure.message',
                    'url' => array(
                        'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                        'text' => 'actions.contribution.cancel.result.failure.link',
                    )
                ));
            }
        } catch (Exception $exception) {
            $this->getLogger()->error(
                "An error occurred while cancelling contribution : " . $exception->getMessage(),
                $exception
            );

            $response = $this->forward('displayNotification@front.notification', array(
                'title' => 'actions.contribution.cancel.result.error.title',
                'message' => 'actions.contribution.cancel.result.error.message',
                'url' => array(
                    'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                    'text' => 'actions.contribution.cancel.result.error.link',
                )
            ));
        }


        return $response;
    }

    /**
     * @param $footprintId
     *
     * @return bool
     *
     * @throws \PGI\Impact\PGClient\Exceptions\Response
     * @throws Exception
     */
    private function reserveCarbon($footprintId) {
        if ($footprintId !== 0) {
            $this->getLogger()->debug("Reserve carbon for footprint '$footprintId'.");

            $reservationResponse = $this->apiFacade->reserveCarbone($footprintId);

            if ($reservationResponse->getHTTPCode() === 201) {
                $this->getLogger()->info("Successful carbon reservation for the footprint '$footprintId'.");

                return true;
            } else {
                throw new Exception("Carbon reservation for footprint '$footprintId' has failed.");
            }
        }

        return false;
    }

    /**
     * @return ForwardResponseComponent
     * @throws Exception
     */
    public function displayContributionExplanationPageAction()
    {
        return $this->forward('displayNotification@front.notification', array(
            'title' => 'misc.tree_user_contribution.explanation.title',
            'message' => 'misc.tree_user_contribution.explanation.message',
            'details' => 'misc.tree_user_contribution.explanation.details'
        ));
    }
}
