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

namespace PGI\Impact\FOTree\Services\OutputBuilders;

use Exception;
use PGI\Impact\PGModule\Components\Output as OutputComponent;
use PGI\Impact\PGModule\Foundations\AbstractOutputBuilder;

/**
 * Class UserContributionOutputBuilder
 * @package FOTree\Services\OutputBuilders
 */
class UserContributionOutputBuilder extends AbstractOutputBuilder
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function build(array $data = array())
    {
        /** @var OutputComponent $output */
        $output = new OutputComponent();

        $content = $this->getViewHandler()->renderTemplate('tree-user-contribution-container');

        $output->setContent($content);
        return $output;
    }
}
