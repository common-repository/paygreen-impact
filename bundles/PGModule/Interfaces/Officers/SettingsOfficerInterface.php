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

namespace PGI\Impact\PGModule\Interfaces\Officers;

/**
 * Interface SettingsOfficerInterface
 * @package PGModule\Interfaces\Officers
 */
interface SettingsOfficerInterface
{
    /**
     * @param $name string
     * @param $defaultValue mixed
     * @return mixed
     */
    public function getOption($name, $defaultValue);

    /**
     * @param $name string
     * @param $value mixed
     * @return mixed
     */
    public function setOption($name, $value);

    /**
     * @param $name string
     * @return mixed
     */
    public function unsetOption($name);

    /**
     * @return void
     */
    public function clean();
}
