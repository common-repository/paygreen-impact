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

namespace PGI\Impact\PGWooCommerce\Services\Strategies;

use PGI\Impact\PGShop\Foundations\AbstractOrderStateMapperStrategy;
use PGI\Impact\PGSystem\Exceptions\Configuration as ConfigurationException;
use Exception;

class OrderStateLocalStrategy extends AbstractOrderStateMapperStrategy
{
    /**
     * @param array $localState
     * @return string|null
     * @throws ConfigurationException
     * @throws Exception
     */
    public function getState(array $localState)
    {
        if (!array_key_exists('state', $localState)) {
            throw new Exception("localState must contains 'state' field.");
        }

        /**
         * @var string $state
         * @var array $definition
         */
        foreach ($this->getDefinitions() as $state => $definition) {
            if (!array_key_exists('code', $definition)) {
                $message = "Parameter 'code' not found in orderState definition : '$state'.";
                throw new ConfigurationException($message);
            }

            if ($definition['code'] === $localState['state']) {
                return $state;
            }
        }

        return null;
    }

    /**
     * @param string $state
     * @return array
     * @throws ConfigurationException
     */
    public function getLocalState($state)
    {
        $definitions = $this->getDefinitions();

        if (!array_key_exists($state, $definitions)) {
            $message = "OrderState definition not found : '$state'.";
            throw new Exception($message);
        } elseif (!array_key_exists('code', $definitions[$state])) {
            $message = "Parameter 'code' not found in orderState definition : '$state'.";
            throw new ConfigurationException($message);
        }

        return array(
            'state' => $definitions[$state]['code']
        );
    }

    /**
     * @param array $localState
     * @return bool
     * @throws ConfigurationException
     */
    public function isRecognizedLocalState(array $localState)
    {
        return ($this->getState($localState) !== null);
    }
}
