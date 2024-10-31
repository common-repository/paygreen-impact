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

namespace PGI\Impact\PGServer\Interfaces;

use PGI\Impact\PGServer\Foundations\AbstractRequest;
use PGI\Impact\PGServer\Foundations\AbstractResponse;
use PGI\Impact\PGSystem\Interfaces\Services\ConfigurableServiceInterface;

/**
 * Interface ActionInterface
 * @package PGServer\Interfaces
 */
interface ActionInterface extends ConfigurableServiceInterface
{

    /**
     * @param AbstractRequest $request
     * @return self
     */
    public function setRequest(AbstractRequest $request);

    /**
     * @return AbstractResponse
     */
    public function process();

    /**
     * @return bool
     */
    public function isSuccess();
}
