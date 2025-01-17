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

namespace PGI\Impact\PGFramework\Services\Handlers;

use PGI\Impact\PGSystem\Foundations\AbstractObject;
use PGI\Impact\PGFramework\Components\Aggregator as AggregatorComponent;
use Exception;

/**
 * Class SelectHandler
 * @package PGFramework\Services\Handlers
 */
class SelectHandler extends AbstractObject
{
    /** @var AggregatorComponent */
    private $selectorAggregator;

    public function __construct(AggregatorComponent $selectorAggregator)
    {
        $this->selectorAggregator = $selectorAggregator;
    }

    /**
     * @param string $name
     * @param string $code
     * @return string
     * @throws Exception
     */
    public function getName($name, $code)
    {
        return $this->selectorAggregator->getService($name)->getName($code);
    }

    /**
     * @param string $name
     * @return array
     * @throws Exception
     */
    public function getChoices($name)
    {
        return $this->selectorAggregator->getService($name)->getChoices();
    }

    /**
     * @param string $name
     * @return array
     * @throws Exception
     */
    public function getKeys($name)
    {
        return $this->selectorAggregator->getService($name)->getKeys();
    }
}
