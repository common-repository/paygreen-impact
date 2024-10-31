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
 * Smarty Method RegisterFilter
 *
 * Smarty::registerFilter() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_RegisterFilter
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * Valid filter types
     *
     * @var array
     */
    private $filterTypes = array('pre' => true, 'post' => true, 'output' => true, 'variable' => true);

    /**
     * Registers a filter function
     *
     * @api  Smarty::registerFilter()
     *
     * @link http://www.smarty.net/docs/en/api.register.filter.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param string                                                          $type filter type
     * @param callback                                                        $callback
     * @param string|null                                                     $name optional filter name
     *
     * @return \Smarty|\Smarty_Internal_Template
     * @throws \SmartyException
     */
    public function registerFilter(Smarty_Internal_TemplateBase $obj, $type, $callback, $name = null)
    {
        $smarty = $obj->_getSmartyObj();
        $this->_checkFilterType($type);
        $name = isset($name) ? $name : $this->_getFilterName($callback);
        if (!is_callable($callback)) {
            throw new SmartyException("{$type}filter '{$name}' not callable");
        }
        $smarty->registered_filters[ $type ][ $name ] = $callback;
        return $obj;
    }

    /**
     * Return internal filter name
     *
     * @param callback $function_name
     *
     * @return string   internal filter name
     */
    public function _getFilterName($function_name)
    {
        if (is_array($function_name)) {
            $_class_name = (is_object($function_name[ 0 ]) ? get_class($function_name[ 0 ]) : $function_name[ 0 ]);
            return $_class_name . '_' . $function_name[ 1 ];
        } elseif (is_string($function_name)) {
            return $function_name;
        } else {
            return 'closure';
        }
    }

    /**
     * Check if filter type is valid
     *
     * @param string $type
     *
     * @throws \SmartyException
     */
    public function _checkFilterType($type)
    {
        if (!isset($this->filterTypes[ $type ])) {
            throw new SmartyException("Illegal filter type '{$type}'");
        }
    }
}
