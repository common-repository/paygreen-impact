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
use PGI\Impact\PGTree\Services\Handlers\TreeAccountHandler;
use PGI\Impact\PGClient\Exceptions\Response as ResponseException;

class TreeAccessAvailableRequirement extends AbstractRequirement
{
    /** @var TreeAccountHandler */
    private $treeAccountHandler;

    public function __construct(TreeAccountHandler $treeAccountHandler)
    {
        $this->treeAccountHandler = $treeAccountHandler;
    }

    /**
     * @inheritDoc
     * @throws ResponseException
     */
    public function isValid()
    {
        $isMandateSigned = $this->treeAccountHandler->isMandateSigned();
        $isTestModeNotExpired = (!$this->treeAccountHandler->isTestModeExpired());

        return ($isTestModeNotExpired || $isMandateSigned);
    }
}
