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
/**
 * Smarty shared plugin
 *
 * @package    Smarty
 * @subpackage PluginsShared
 */
/**
 * escape_special_chars common function
 * Function: smarty_function_escape_special_chars
 * Purpose:  used by other smarty functions to escape
 *           special chars except for already escaped ones
 *
 * @author Monte Ohrt <monte at ohrt dot com>
 *
 * @param string $string text that should by escaped
 *
 * @return string
 */
function smarty_function_escape_special_chars($string)
{
    if (!is_array($string)) {
        if (version_compare(PHP_VERSION, '5.2.3', '>=')) {
            $string = htmlspecialchars($string, ENT_COMPAT, Smarty::$_CHARSET, false);
        } else {
            $string = preg_replace('!&(#?\w+);!', '%%%SMARTY_START%%%\\1%%%SMARTY_END%%%', $string);
            $string = htmlspecialchars($string);
            $string = str_replace(array('%%%SMARTY_START%%%', '%%%SMARTY_END%%%'), array('&', ';'), $string);
        }
    }
    return $string;
}
