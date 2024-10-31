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

namespace PGI\Impact\PGTree\Services\Requirements;

use PGI\Impact\PGFramework\Foundations\AbstractRequirement;
use PGI\Impact\PGModule\Services\Settings;
use PGI\Impact\PGClient\Exceptions\Response as ResponseException;

class CarbonBotJSRequirement extends AbstractRequirement
{
    /** @var Settings */
    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @inheritDoc
     * @throws ResponseException
     */
    public function isValid()
    {
        $isCarbonBotActivated = ($this->settings->get("tree_bot_displayed") !== 2);
        $isContributionNeeded = $this->settings->get('tree_user_contribution');

        return ($isCarbonBotActivated || $isContributionNeeded);
    }
}
