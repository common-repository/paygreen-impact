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

use PGI\Impact\PGWordPress\Bridges\WordPressBridge as WordPressBridgeBridge;

/**
 * Plugin Name: PayGreen Impact
 * Plugin URI: http://www.paygreen.io
 * Description: Le module français à impact positif sur la société et l'environnement.
 * Author: WattIsIt
 * Original Author: Renaud Gerson
 * Version: 1.3.7
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WC_PGImpact')) {
    define('PGIMPACT_MODULE_FILE', __FILE__);

    require_once dirname(PGIMPACT_MODULE_FILE) . DIRECTORY_SEPARATOR . 'bootstrap.php';

    new WordPressBridgeBridge();
}
