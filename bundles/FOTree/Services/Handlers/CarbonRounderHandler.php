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

namespace PGI\Impact\FOTree\Services\Handlers;

use Exception;
use PGI\Impact\PGIntl\Services\Handlers\LocaleHandler;
use NumberFormatter;

/**
 * Class CarbonRounderHandler
 * @package FOTree\Services\Handlers
 */
class CarbonRounderHandler
{
    /** @var LocaleHandler */
    private $localeHandler;

    public function __construct(LocaleHandler $localeHandler)
    {
        $this->localeHandler = $localeHandler;
    }

    public function roundNumber($number)
    {
        $numberKg = $this->convertTonToKiloGram($number);

        if ($numberKg >= 10) {
            $result = $this->formatNumber(round($numberKg,0,PHP_ROUND_HALF_DOWN))." kg";
        } elseif ($numberKg < 1) {
            $numberG = $this->convertTonToGram($number);
            $result = $this->formatNumber(round($numberG,0,PHP_ROUND_HALF_DOWN))." g";
        } else {
            $result = $this->formatNumber(round($numberKg, 2, PHP_ROUND_HALF_DOWN))." kg";
        }

        return $result;
    }

    private function formatNumber($number)
    {
        $formatter = new NumberFormatter($this->localeHandler->getLanguage(), NumberFormatter::DECIMAL);

        return $formatter->format($number);
    }

    private function convertTonToGram($carbonEmission)
    {
        return ($carbonEmission * 1000000);
    }

    private function convertTonToKiloGram($carbonEmission)
    {
        return ($carbonEmission * 1000);
    }
}
