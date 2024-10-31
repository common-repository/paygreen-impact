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

namespace PGI\Impact\PGSystem\Components\Builders;

use PGI\Impact\PGSystem\Components\Parameters as ParametersComponent;
use PGI\Impact\PGSystem\Components\Service\Library as LibraryServiceComponent;
use PGI\Impact\PGSystem\Services\Container as PaygreenContainer;
use PGI\Impact\PGSystem\Services\Pathfinder;
use Exception;

/**
 * Class Container
 * @package PGSystem\Components\Builders
 */
class Container
{
    /** @var Pathfinder */
    private $pathfinder;

    public function __construct(Pathfinder $pathfinder)
    {
        $this->pathfinder = $pathfinder;
    }

    /**
     * @return PaygreenContainer
     * @throws Exception
     */
    public function buildContainer()
    {
        $container = PaygreenContainer::getInstance();

        $this->loadServiceLibrary($container);
        $this->loadParameters($container);

        return $container;
    }

    /**
     * @param PaygreenContainer $container
     * @throws Exception
     */
    private function loadServiceLibrary(PaygreenContainer $container)
    {
        /** @var LibraryServiceComponent $library */
        $library = $container->get('service.library');

        if (defined('PGIMPACT_SUBSET')) {
            $filename = 'container-' . PGIMPACT_SUBSET . '.php';
        } else {
            $filename = 'container.php';
        }

        $path = $this->pathfinder->toAbsolutePath("data:/$filename");

        $library->setSource($path)->reset();
    }

    /**
     * @param PaygreenContainer $container
     * @throws Exception
     */
    private function loadParameters(PaygreenContainer $container)
    {
        /** @var ParametersComponent $parameters */
        $parameters = $container->get('parameters');

        if (defined('PGIMPACT_SUBSET')) {
            $filename = 'parameters-' . PGIMPACT_SUBSET . '.php';
        } else {
            $filename = 'parameters.php';
        }

        $path = $this->pathfinder->toAbsolutePath("data:/$filename");

        $parameters->setSource($path)->reset();
    }
}
