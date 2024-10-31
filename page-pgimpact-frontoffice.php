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

use PGI\Impact\PGSystem\Services\Container;
use PGI\Impact\PGWordPress\Services\Handlers\FrontofficeHandler;

/**
Template Name: PGImpact Frontoffice
Template Post Type: page
*/


/** @var FrontofficeHandler $frontOfficeHandler */
$frontOfficeHandler = Container::getInstance()->get('handler.frontoffice');

$content = $frontOfficeHandler->run();

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <p><?php echo $content; ?></p>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();