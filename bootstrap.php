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

use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ShopEntityInterface;
use PGI\Impact\PGShop\Services\Handlers\ShopHandler;
use PGI\Impact\PGSystem\Components\Bootstrap as BootstrapComponent;

/**
 * @param Exception $exception
 * @param bool $throw
 * @throws Exception
 */
function catchLowLevelImpactException(Exception $exception, $throw = true)
{
    $file = $exception->getFile();
    $line = $exception->getLine();
    $message = "Error during PGImpact module execution ($file#$line) : {$exception->getMessage()}";

    error_log($message);

    if (defined('PGIMPACT_ENV') && (PGIMPACT_ENV === 'DEV')) {
        die($message);
    } elseif ($throw) {
        throw $exception;
    }
}

try {
    // #############################################################################################
    // Setting module constants
    // #############################################################################################

    if (!defined('DS')) {
        define('DS', DIRECTORY_SEPARATOR);
    }

    $varPath = get_temp_dir();
    if ($varPath === '/tmp/') {
        $varPath = WP_CONTENT_DIR . DS . 'var' . DS;
    }

    define('PGIMPACT_MODULE_DIR', WP_PLUGIN_DIR . DS . 'paygreen-impact');
    define('PGIMPACT_MODULE_NAME', plugin_basename(PGIMPACT_MODULE_FILE));
    define('PGIMPACT_VENDOR_DIR', PGIMPACT_MODULE_DIR . DS . 'bundles');
    define('PGIMPACT_VAR_DIR', $varPath . 'pgimpact');
    define('PGIMPACT_MEDIA_DIR', WP_CONTENT_DIR . DS . 'uploads' . DS . 'pgimpact');
    define('PGIMPACT_DATA_DIR', PGIMPACT_MODULE_DIR . DS . 'data');
    define('PGIMPACT_DB_PREFIX', $GLOBALS['wpdb']->base_prefix);
    define('PGIMPACT_CONTENT_URL', content_url());

    define('PGIMPACT_MODULE_VERSION', require(PGIMPACT_DATA_DIR . DS . 'module_version.php'));

    require_once(PGIMPACT_MODULE_DIR . DS . 'includer.php');

    // #############################################################################################
    // Running Bootstrap
    // #############################################################################################

    $bootstrap = new BootstrapComponent();
    
    $bootstrap
        ->buildKernel(PGIMPACT_DATA_DIR)
        ->buildPathfinder(array(
            'static' => PGIMPACT_MODULE_DIR . '/static',
            'module' => PGIMPACT_MODULE_DIR,
            'data' => PGIMPACT_MODULE_DIR . '/data',
            'var' => PGIMPACT_VAR_DIR,
            'log' => PGIMPACT_VAR_DIR . '/logs',
            'cache' => PGIMPACT_VAR_DIR . '/cache',
            'media' => PGIMPACT_MEDIA_DIR,
            'templates' => PGIMPACT_MODULE_DIR . '/templates'
        ))
        ->createVarFolder()
        ->registerAutoloader('PGI\Impact\PGSystem\Components\Builders\AutoloaderCompiled')
        ->buildContainer()
        ->insertStaticServices()
    ;

    /** @var ShopHandler $shopHandler */
    $shopHandler = $bootstrap->getContainer()->get('handler.shop');

    /** @var ShopEntityInterface $shop */
    $shop = $shopHandler->getCurrentShop();

    if ($shopHandler->isMultiShopActivated()) {
        define('PGIMPACT_CACHE_PREFIX', 'shop-' . $shop->id());
    }

    $bootstrap->setup();

    // #############################################################################################
    // Init Shop
    // #############################################################################################

    /** @var LoggerInterface $logger */
    $logger = $bootstrap->getContainer()->get('logger');

    $logger->debug("Current shop detected : {$shop->getName()} #{$shop->id()}.");
    $logger->debug("Running PGImpact module for URI : {$_SERVER['REQUEST_URI']}");


    // #############################################################################################
    // Logging PHP errors
    // #############################################################################################

    if (PGIMPACT_ENV === 'DEV') {
        ini_set('error_log', $bootstrap->getPathfinder()->toAbsolutePath('log', '/error.log'));
    }
} catch (Exception $exception) {
    catchLowLevelImpactException($exception);
}
