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

namespace PGI\Impact\PGModule\Foundations;

use PGI\Impact\PGModule\Foundations\AbstractEvent;
use PGI\Impact\PGModule\Interfaces\Builders\OutputBuilderInterface;
use PGI\Impact\PGSystem\Components\Bag as BagComponent;
use PGI\Impact\PGSystem\Interfaces\Services\ConfigurableServiceInterface;
use PGI\Impact\PGView\Services\Handlers\ViewHandler;

/**
 * Class AbstractEvent
 * @package PGModule\Foundations
 */
abstract class AbstractOutputBuilder implements OutputBuilderInterface, ConfigurableServiceInterface
{
    /** @var BagComponent */
    private $config;

    /** @var ViewHandler */
    private $viewHandler;

    /**
     * AbstractOutputBuilder constructor.
     */
    public function __construct()
    {
        $this->setConfig(array());
    }

    /**
     * @inheritDoc
     */
    abstract public function build(array $data = array());

    /**
     * @param ViewHandler $viewHandler
     */
    public function setViewHandler(ViewHandler $viewHandler)
    {
        $this->viewHandler = $viewHandler;
    }

    /**
     * @return ViewHandler
     */
    protected function getViewHandler()
    {
        return $this->viewHandler;
    }

    /**
     * @inheritDoc
     */
    public function setConfig(array $config)
    {
        $this->config = new BagComponent($config);
    }

    /**
     * @inheritDoc
     */
    public function addConfig(array $config)
    {
        $this->config->merge($config);
    }

    /**
     * @inheritDoc
     */
    public function hasConfig($key)
    {
        return isset($this->config[$key]);
    }

    /**
     * @inheritDoc
     */
    public function getConfig($key)
    {
        return $this->config[$key];
    }
}
