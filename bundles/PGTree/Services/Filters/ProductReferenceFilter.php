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

namespace PGI\Impact\PGTree\Services\Filters;

use Exception;
use PGI\Impact\PGFramework\Tools\Character;

/**
 * Class ProductReferenceFilter
 * @package PGTree\Services\Filters
 */
class ProductReferenceFilter
{
    /**
     * @param string $value
     * @throws Exception
     */
    public function filter($value)
    {
        $value = trim(str_replace(' ', '_', Character::removeAccents($value)));

        $value = preg_replace('/[^a-zA-Z0-9_\-]+/', '-', $value);

        if (strlen($value) > 255) {
            $value = substr($value, 0, 254);
        }

        return $value;
    }
}
