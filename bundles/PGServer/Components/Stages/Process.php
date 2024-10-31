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

namespace PGI\Impact\PGServer\Components\Stages;

use PGI\Impact\PGServer\Foundations\AbstractResponse;
use PGI\Impact\PGServer\Foundations\AbstractStage;
use Exception;

/**
 * Class Process
 * @package PGServer\Components\Stages
 */
class Process extends AbstractStage
{
    const STAGE_TYPE = 'Processor';
    const STAGE_METHOD = 'process';

    /**
     * @param AbstractResponse $response
     * @return void
     * @throws Exception
     */
    public function execute(AbstractResponse $response)
    {
        $this->callService($response);

        $this->getLogger()->debug("Processor executed successfully.");
    }
}
