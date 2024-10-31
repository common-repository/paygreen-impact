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

namespace PGI\Impact\PGIntl\Services\Selectors;

use PGI\Impact\PGFramework\Foundations\AbstractSelector;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use Exception;

/**
 * Class CountrySelector
 * @package PGIntl\Services\Selectors
 */
class CountrySelector extends AbstractSelector
{
    public function __construct(LoggerInterface $logger, array $countries)
    {
        parent::__construct($logger);

        $choices = array_combine($countries, $countries);

        array_walk($choices, function (&$value) {
            $value = "countries.$value";
        });

        $this->setChoices($choices);
    }

    protected function buildChoices()
    {
        throw new Exception("StaticSelector cannot build choice list.");
    }
}
