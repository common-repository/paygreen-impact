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
 * Smarty Method GetLiterals
 *
 * Smarty::getLiterals() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_Literals
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * Get literals
     *
     * @api Smarty::getLiterals()
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     *
     * @return array list of literals
     */
    public function getLiterals(Smarty_Internal_TemplateBase $obj)
    {
        $smarty = $obj->_getSmartyObj();
        return (array)$smarty->literals;
    }

    /**
     * Add literals
     *
     * @api Smarty::addLiterals()
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param array|string                                                    $literals literal or list of literals
     *                                                                                  to addto add
     *
     * @return \Smarty|\Smarty_Internal_Template
     * @throws \SmartyException
     */
    public function addLiterals(Smarty_Internal_TemplateBase $obj, $literals = null)
    {
        if (isset($literals)) {
            $this->set($obj->_getSmartyObj(), (array)$literals);
        }
        return $obj;
    }

    /**
     * Set literals
     *
     * @api Smarty::setLiterals()
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param array|string                                                    $literals literal or list of literals
     *                                                                                  to setto set
     *
     * @return \Smarty|\Smarty_Internal_Template
     * @throws \SmartyException
     */
    public function setLiterals(Smarty_Internal_TemplateBase $obj, $literals = null)
    {
        $smarty = $obj->_getSmartyObj();
        $smarty->literals = array();
        if (!empty($literals)) {
            $this->set($smarty, (array)$literals);
        }
        return $obj;
    }

    /**
     * common setter for literals for easier handling of duplicates the
     * Smarty::$literals array gets filled with identical key values
     *
     * @param \Smarty $smarty
     * @param array   $literals
     *
     * @throws \SmartyException
     */
    private function set(Smarty $smarty, $literals)
    {
        $literals = array_combine($literals, $literals);
        $error = isset($literals[ $smarty->left_delimiter ]) ? array($smarty->left_delimiter) : array();
        $error = isset($literals[ $smarty->right_delimiter ]) ? $error[] = $smarty->right_delimiter : $error;
        if (!empty($error)) {
            throw new SmartyException(
                'User defined literal(s) "' . $error .
                '" may not be identical with left or right delimiter'
            );
        }
        $smarty->literals = array_merge((array)$smarty->literals, (array)$literals);
    }
}