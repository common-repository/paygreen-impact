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

namespace PGI\Impact\FOCharity\Services\OutputBuilders;

use Exception;
use PGI\Impact\PGCharity\Services\Handlers\CharityHandler;
use PGI\Impact\PGCharity\Services\Handlers\CharityPartnershipHandler;
use PGI\Impact\PGModule\Components\Output as OutputComponent;
use PGI\Impact\PGModule\Foundations\AbstractOutputBuilder;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGServer\Components\Resources\ScriptFile as ScriptFileResourceComponent;
use PGI\Impact\PGServer\Components\Resources\StyleFile as StyleFileResourceComponent;
use PGI\Impact\PGServer\Components\Resources\Data as DataResourceComponent;
use PGI\Impact\PGServer\Services\Handlers\LinkHandler;

/**
 * Class CharityBlockOutputBuilder
 * @package FOCharity\Services\OutputBuilders
 */
class CharityBlockOutputBuilder extends AbstractOutputBuilder
{
    /** @var CharityHandler */
    private $charityHandler;

    /** @var LinkHandler */
    private $linkHandler;

    /** @var Settings */
    private $settings;

    /** @var CharityPartnershipHandler */
    private $charityPartnershipHandler;

    public function __construct(
        CharityHandler $charityHandler,
        LinkHandler $linkHandler,
        Settings $settings,
        CharityPartnershipHandler $charityPartnershipHandler
    ) {
        parent::__construct();

        $this->charityHandler = $charityHandler;
        $this->linkHandler = $linkHandler;
        $this->settings = $settings;
        $this->charityPartnershipHandler = $charityPartnershipHandler;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function build(array $data = array())
    {
        $isCharityTestModeActivated = $this->settings->get('charity_test_mode');

        /** @var OutputComponent $output */
        $output = new OutputComponent();

        $partnerships = $this->charityPartnershipHandler->getPartnerships();
        $currentPartnership = null;

        $hasGift = "false";
        if ($this->charityHandler->hasGift()) {
            $hasGift = "true";
            foreach ($partnerships as $partnership) {
                if ($partnership->association->idAssociation == $this->charityHandler->getCurrentPartnershipPrimary()) {
                    $currentPartnership = $partnership;
                }
            }
        }

        if (sizeof($partnerships) === 0) {
            $content = "";
        } else if (!$this->charityHandler->hasGift() && (sizeof($partnerships) === 1)) {
            $content = $this->getViewHandler()->renderTemplate('charity-display-single-partnership', array(
                'currentAmount' => number_format($this->charityHandler->getCurrentAmount(), 2),
                'isCharityTestModeActivated' => $isCharityTestModeActivated,
                'partnership' => $partnerships[0]
            ));
            $output->addResource(new ScriptFileResourceComponent('/js/charity-single-partnership.js'));
            $output->addResource(new StyleFileResourceComponent('/css/charity-frontoffice-single-partnership.css'));
        } else {
            $content = $this->getViewHandler()->renderTemplate('charity-container', array(
                'hasGift' => $this->charityHandler->hasGift(),
                'currentAmount' => number_format($this->charityHandler->getCurrentAmount(), 2),
                'isCharityTestModeActivated' => $isCharityTestModeActivated,
                'partnership' => $currentPartnership
            ));
            $output->addResource(new ScriptFileResourceComponent('/js/charity.js'));
            $output->addResource(new StyleFileResourceComponent('/css/charity-frontoffice.css'));

            $output->addResource(new DataResourceComponent(array(
                'paygreen_charity_popin_template_url' => $this->linkHandler->buildFrontOfficeUrl('front.charity.display_popin'),
                'paygreen_charity_cancel_gift' => $this->linkHandler->buildFrontOfficeUrl('front.charity.cancel_gift'),
                'paygreen_charity_has_gift' => $hasGift
            )));
        }

        $output->setContent($content);

        return $output;
    }
}
