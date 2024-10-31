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
use PGI\Impact\PGForm\Interfaces\Views\FormViewInterface;
use PGI\Impact\PGServer\Components\Responses\Redirection as RedirectionResponseComponent;
use PGI\Impact\PGServer\Components\Responses\Template as TemplateResponseComponent;
use PGI\Impact\PGTree\Services\Managers\CarrierEquivalenceManager;
use PGI\Impact\PGTree\Services\Managers\CarrierManager;
use PGI\Impact\PGView\Components\Box as BoxComponent;
use Exception;

/**
 * Class DeliveryMethodsController
 * @package BOTree\Services\Controllers
 */

class DeliveryMethodsController extends AbstractBackofficeController
{

    /** @var CarrierEquivalenceManager */
    private $carrierEquivalenceManager;

    /** @var CarrierManager */
    private $carrierManager;

    public function __construct(
        CarrierEquivalenceManager $carrierEquivalenceManager,
        CarrierManager $carrierManager
    ) {
        $this->carrierEquivalenceManager = $carrierEquivalenceManager;
        $this->carrierManager = $carrierManager;
    }

    /**
     * @return RedirectionResponseComponent
     * @throws Exception
     */
    public function saveDeliveryMethodsAction()
    {
        /** @var FormInterface $form */
        $form = $this->buildForm('delivery_methods', $this->getRequest()->getAll());

        if ($form->isValid()) {
            $this->carrierEquivalenceManager->saveCarrierEquivalence($form["delivery_methods"]);
            $this->success('actions.eligible_amounts.save.result.success');
        } else {
            $this->failure('actions.eligible_amounts.save.result.failure');
        }

        return $this->redirect($this->getLinkHandler()->buildBackOfficeUrl('backoffice.tree_config.display'));
    }

    /**
     * @return TemplateResponseComponent
     * @throws Exception
     */
    public function displayFormDeliveryMethodsAction()
    {
        $response =  $this->buildTemplateResponse('delivery-methods/block-form-delivery-methods', array(
            'deliveryMethodsViewForm' => $this->buildDeliveryMethodsForm()
        ));

        return $response;
    }

    /**
     * @return BoxComponent
     * @throws Exception
     */
    private function buildDeliveryMethodsForm()
    {
        $dataReferences = $this->carrierEquivalenceManager->getReferences();
        $dataEquivalences = $this->carrierEquivalenceManager->getEquivalences();

        $datas = array_combine($dataReferences,$dataEquivalences);

        $allCarriers = $this->carrierManager->getAllNames();

        foreach (array_keys($allCarriers) as $key) {
            if(empty($datas[$key])) {
                $datas[$key] = "DEFAULT";
            }
        }

        /** @var FormViewInterface $deliveryMethodsViewForm */
        $deliveryMethodsViewForm = $this->buildForm('delivery_methods')
            ->setValue('delivery_methods', $datas)
            ->buildView();

        $deliveryMethodsViewForm->setAction(
            $this->getLinkHandler()->buildBackOfficeUrl('backoffice.delivery_methods.save')
        );

        return new BoxComponent($deliveryMethodsViewForm);
    }
}
