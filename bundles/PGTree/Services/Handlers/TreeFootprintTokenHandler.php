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

namespace PGI\Impact\PGTree\Services\Handlers;

use PGI\Impact\APITree\Services\Facades\ApiFacade;
use PGI\Impact\PGFramework\Services\Handlers\CookieHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use DateTime;
use Exception;

/**
 * Class TreeFootprintTokenHandler
 * @package PGTree\Services\Handlers
 */
class TreeFootprintTokenHandler
{
    const FOOTPRINT_TOKEN_COOKIE_NAME = 'pgFootprintToken';

    /** @var ApiFacade */
    private $apiFacade;

    /** @var CookieHandler */
    private $cookieHandler;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        ApiFacade $apiFacade,
        CookieHandler $cookieHandler,
        LoggerInterface $logger
    ) {
        $this->apiFacade = $apiFacade;
        $this->cookieHandler = $cookieHandler;
        $this->logger = $logger;
    }

    /**
     * @param string $footprint
     * @return array|null
     * @throws Exception
     */
    public function getToken($footprint)
    {
        if (!$this->cookieHandler->has(self::FOOTPRINT_TOKEN_COOKIE_NAME) || $this->cookieHandler->get(self::FOOTPRINT_TOKEN_COOKIE_NAME) === '') {
            $this->logger->warning('Footprint token cookie not found.');
            return $this->createToken($footprint);
        } else {
            $token = stripslashes($this->cookieHandler->get(self::FOOTPRINT_TOKEN_COOKIE_NAME));
            if ($token !== '') {
                $token = json_decode($token, true);

                if ($this->isExpired($token)) {
                    return $this->createToken($footprint);
                } else {
                    return $token['token'];
                }
            }
        }

        return null;
    }

    /**
     * @throws Exception
     */
    public function resetToken()
    {
        $this->logger->debug("Reset '" . self::FOOTPRINT_TOKEN_COOKIE_NAME . "' cookie.");
        $this->cookieHandler->set(self::FOOTPRINT_TOKEN_COOKIE_NAME, null);
    }

    /**
     * @param string $footprint
     * @throws Exception
     */
    public function createToken($footprint)
    {
        $this->logger->debug("Create temporary token for footprint '$footprint'.");
        $this->cookieHandler->set(self::FOOTPRINT_TOKEN_COOKIE_NAME, null);

        try {
            $tokenResponse = $this->apiFacade->getTemporaryToken($footprint);

            if ($tokenResponse->getHTTPCode() === 200) {
                $token = array();
                $token['token'] = $tokenResponse->data->access_token;

                $datetime = new DateTime();
                $token['expiresAt'] = $datetime->getTimestamp() + $tokenResponse->data->expires_in;

                $this->cookieHandler->set(self::FOOTPRINT_TOKEN_COOKIE_NAME, json_encode($token));

                return $token['token'];
            } else {
                $this->logger->error("An error occurred while creating temporary token for footprint '$footprint'.");

                return null;
            }
        } catch (Exception $exception) {
            $this->logger->error("Unable to create temporary token : " . $exception->getMessage(), $exception);

            return null;
        }
    }

    /**
     * @param array $token
     *
     * @return false
     */
    private function isExpired(array $token)
    {
        $datetime = new DateTime();
        $timestamp = $datetime->getTimestamp();

        return ($timestamp > $token['expiresAt'] || (($token['expiresAt'] - $timestamp) < 120));
    }
}
