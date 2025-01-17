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

namespace PGI\Impact\PGFramework\Foundations;

use PGI\Impact\PGSystem\Components\Bag as BagComponent;
use PGI\Impact\PGSystem\Interfaces\Services\ConfigurableServiceInterface;

/**
 * Class AbstractService
 * @package PGFramework\Foundations
 */
abstract class AbstractConfigurableService implements ConfigurableServiceInterface
{
    /** @var BagComponent */
    private $config = null;

    public function setConfig(array $config)
    {
        $this->config = new BagComponent($config);
    }

    public function addConfig(array $config)
    {
        if ($this->config === null) {
            $this->setConfig($config);
        } else {
            $this->config->merge($config);
        }
    }

    public function hasConfig($key)
    {
        return isset($this->config[$key]);
    }

    public function getConfig($key)
    {
        return $this->config[$key];
    }
}
