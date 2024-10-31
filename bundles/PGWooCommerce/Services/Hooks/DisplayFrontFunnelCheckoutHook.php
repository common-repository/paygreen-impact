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

namespace PGI\Impact\PGWooCommerce\Services\Hooks;

use PGI\Impact\PGModule\Services\Providers\OutputProvider;
use Exception;

/**
 * Class DisplayFrontFunnelCheckoutHook
 * @package PGWooCommerce\Services\Hooks
 */
class DisplayFrontFunnelCheckoutHook
{
    /** @var OutputProvider */
    private $outputProvider;

    public function __construct(OutputProvider $outputProvider)
    {
        $this->outputProvider = $outputProvider;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function displayFrontFunnelCheckout()
    {
        $output = $this->outputProvider->getZoneOutput('FRONT.FUNNEL.CHECKOUT');

        echo $output->getContent();
    }
}
