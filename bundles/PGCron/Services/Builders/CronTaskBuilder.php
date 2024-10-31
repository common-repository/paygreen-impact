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

namespace PGI\Impact\PGCron\Services\Builders;

use Exception;
use PGI\Impact\PGCron\Interfaces\CronTaskInterface;
use PGI\Impact\PGFramework\Components\Aggregator;
use PGI\Impact\PGFramework\Foundations\AbstractService;
use PGI\Impact\PGSystem\Components\Bag;
use PGI\Impact\PGSystem\Components\Parser;

class CronTaskBuilder extends AbstractService
{
    /** @var Aggregator */
    private $cronTasks;

    /** @var Parser */
    private $parser;

    public function __construct(Aggregator $cronTaskAggregator, Parser $parser)
    {
        $this->cronTasks = $cronTaskAggregator;
        $this->parser = $parser;
    }

    /**
     * @param $name
     * @return CronTaskInterface
     * @throws \PGI\Impact\PGSystem\Exceptions\ParserConstant
     * @throws \PGI\Impact\PGSystem\Exceptions\ParserParameter
     */
    public function build($name)
    {
        /** @var Bag $config */
        $config = $this->getCronTaskConfig($name);

        /** @var CronTaskInterface $service */
        $service = $this->cronTasks->getService($config['task']);

        if ($config['config']) {
            $service->addConfig($this->parser->parseConfig($config['config']));
        }

        return $service;
    }

    /**
     * @param string $name
     * @return Bag
     */
    protected function getCronTaskConfig($name)
    {
        $rawConfig = $this->getConfig("tasks.$name");

        if (!is_array($rawConfig)) {
            throw new Exception("Cron task '$name' does not have valid configuration.");
        }

        $config = new Bag($rawConfig);

        if (!$config['task']) {
            throw new Exception("Undefined service for cron task '$name'.");
        }

        return $config;
    }
}