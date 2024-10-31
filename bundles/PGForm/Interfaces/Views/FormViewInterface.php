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

namespace PGI\Impact\PGForm\Interfaces\Views;

use PGI\Impact\PGForm\Components\Form as FormComponent;
use PGI\Impact\PGView\Interfaces\ViewInterface;

/**
 * Interface FormViewInterface
 * @package PGForm\Interfaces\Views
 */
interface FormViewInterface extends ViewInterface
{
    /**
     * @param FormComponent $field
     * @return self
     */
    public function setForm(FormComponent $field);

    /**
     * @param $action
     * @return self
     */
    public function setAction($action);
}
