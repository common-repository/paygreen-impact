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

namespace PGI\Impact\PGView\Interfaces;

/**
 * Interface ViewInterface
 * @package PGView\Interfaces
 */
interface ViewInterface
{
    /**
     * @param array $data
     * @return self
     */
    public function setData(array $data);

    /**
     * @return array
     */
    public function getData();

    /**
     * @param string $target
     * @return self
     */
    public function setTemplate($target);

    /**
     * @return string
     */
    public function render();
}
