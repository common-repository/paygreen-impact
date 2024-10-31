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

namespace PGI\Impact\FOCharity\Services\Controllers;

use Exception;
use PGI\Impact\BOModule\Foundations\Controllers\AbstractBackofficeController;
use PGI\Impact\PGCharity\Services\Handlers\CharityHandler;
use PGI\Impact\PGFramework\Services\Handlers\SessionHandler;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Forward as ForwardResponseComponent;
use PGI\Impact\PGShop\Services\Managers\CartManager;

/**
 * Class CharityGiftController
 * @package FOCharity\Services\Controllers
 */
class CharityGiftController extends AbstractBackofficeController
{
    const CHARITY_ASSOCIATION_ID_SESSION_NAME = 'paygreen_charity_association_id';

    /** @var CharityHandler */
    private $charityHandler;

    /** @var SessionHandler */
    private $sessionHandler;

    /** @var CartManager */
    private $cartManager;

    public function __construct(
        CharityHandler $charityHandler,
        SessionHandler $sessionHandler,
        CartManager $cartManager
    ) {
        $this->charityHandler = $charityHandler;
        $this->sessionHandler = $sessionHandler;
        $this->cartManager = $cartManager;
    }

    /**
     * @return RedirectionResponseComponent|ForwardResponseComponent
     * @throws Exception
     */
    public function saveGiftAction()
    {
        $giftAmount = (float)$this->getRequest()->get('pgcharity-gift-amount');
        $giftAssociationId = (int) $this->getRequest()->get('pgcharity-gift-association');

        try {
            $this->sessionHandler->set(self::CHARITY_ASSOCIATION_ID_SESSION_NAME, $giftAssociationId);

            if ($this->charityHandler->addGift($giftAmount, $this->cartManager->getCurrentCartId(), $giftAssociationId)) {
                $response = $this->redirect($this->getLinkHandler()->buildLocalUrl('checkout'));
            } else {
                $response = $this->forward('displayNotification@front.notification', array(
                    'title' => 'actions.gift.save.result.failure.title',
                    'message' => 'actions.gift.save.result.failure.message',
                    'url' => array(
                        'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                        'text' => 'actions.gift.save.result.failure.link',
                    )
                ));
            }
        } catch (Exception $exception) {
            $this->getLogger()->error(
                "An error occured while saving gift : " . $exception->getMessage(),
                $exception
            );

            $response = $this->forward('displayNotification@front.notification', array(
                'title' => 'actions.gift.save.result.error.title',
                'message' => 'actions.gift.save.result.error.message',
                'url' => array(
                    'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                    'text' => 'actions.gift.save.result.error.link',
                )
            ));
        }

        return $response;
    }

    public function cancelGiftAction()
    {
        try {
            $this->sessionHandler->rem(self::CHARITY_ASSOCIATION_ID_SESSION_NAME);

            if ($this->charityHandler->removeGift()) {
                $response = $this->redirect($this->getLinkHandler()->buildLocalUrl('checkout'));
            } else {
                $response = $this->forward('displayNotification@front.notification', array(
                    'title' => 'actions.gift.cancel.result.failure.title',
                    'message' => 'actions.gift.cancel.result.failure.message',
                    'url' => array(
                        'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                        'text' => 'actions.gift.cancel.result.failure.link',
                    )
                ));
            }
        } catch (Exception $exception) {
            $this->getLogger()->error(
                "An error occured while cancelling gift : " . $exception->getMessage(),
                $exception
            );

            $response = $this->forward('displayNotification@front.notification', array(
                'title' => 'actions.gift.cancel.result.error.title',
                'message' => 'actions.gift.cancel.result.error.message',
                'url' => array(
                    'link' => $this->getLinkHandler()->buildLocalUrl('checkout'),
                    'text' => 'actions.gift.cancel.result.error.link',
                )
            ));
        }

        return $response;
    }

    /**
     * @return ForwardResponseComponent
     * @throws Exception
     */
    public function displayGiftExplanationPageAction()
    {
        return $this->forward('displayNotification@front.notification', array(
            'title' => 'misc.charity.gift.explanation.title',
            'message' => 'misc.charity.gift.explanation.message',
            'details' => 'misc.charity.gift.explanation.details'
        ));
    }
}
