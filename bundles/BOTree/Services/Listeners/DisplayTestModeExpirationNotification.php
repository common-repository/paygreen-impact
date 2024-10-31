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

namespace PGI\Impact\BOTree\Services\Listeners;

use PGI\Impact\PGTree\Services\Handlers\TreeAccountHandler;
use PGI\Impact\PGClient\Exceptions\Response as ResponseException;
use PGI\Impact\PGFramework\Services\Notifier;
use PGI\Impact\PGServer\Components\Events\Action as ActionEventComponent;

/**
 * Class DisplayTestModeExpirationNotificationListener
 * @package BOTree\Services\Listeners
 */
class DisplayTestModeExpirationNotificationListener
{
    /** @var Notifier */
    private $notifier;

    /** @var TreeAccountHandler */
    private $treeAccountHandler;

    private $bin;

    public function __construct(
        Notifier $notifier,
        TreeAccountHandler $treeAccountHandler
    ) {
        $this->notifier = $notifier;
        $this->treeAccountHandler = $treeAccountHandler;
    }

    /**
     * @param ActionEventComponent $event
     * @throws ResponseException
     */
    public function listen(ActionEventComponent $event)
    {
        // Thrashing unused arguments
        $this->bin = $event;

        if ($this->treeAccountHandler->isTestModeExpired() && !$this->treeAccountHandler->isMandateSigned()) {
            $this->notifier->add(
                Notifier::STATE_NOTICE,
                'misc.tree_account.notifications.test_mode.expired'
            );
        }
    }
}
