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

namespace PGI\Impact\PGCharity\Services\Handlers;

use Exception;
use PGI\Impact\APICharity\Services\Facades\ApiFacade;
use PGI\Impact\PGClient\Exceptions\Response;
use PGI\Impact\PGClient\Exceptions\ResponseHTTPError;
use PGI\Impact\PGFramework\Services\Handlers\CacheHandler;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGModule\Services\Settings;

/**
 * Class CharityAssociationHandler
 * @package PGCharity\Services\Handlers
 */
class CharityPartnershipHandler
{
    const CHARITY_PARTNERSHIP_CACHE_KEY = 'charity_partnerships';

    /** @var ApiFacade */
    private $charityAPIFacade;

    /** @var CacheHandler */
    private $cacheHandler;

    /** @var Settings */
    private $settings;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        ApiFacade $charityAPIFacade,
        CacheHandler $cacheHandler,
        Settings $settings,
        LoggerInterface $logger
    ) {
        $this->charityAPIFacade = $charityAPIFacade;
        $this->cacheHandler = $cacheHandler;
        $this->settings = $settings;
        $this->logger = $logger;
    }

    /**
     * @throws Response
     * @throws Exception
     */
    public function getPartnerships()
    {
        $this->logger->debug('Get partnerships');

        $partnerships = $this->cacheHandler->loadEntry(self::CHARITY_PARTNERSHIP_CACHE_KEY);

        if ($partnerships === null) {
            try {
                $partnershipGroupsRawData = $this->charityAPIFacade->getPartnershipDefaultGroups();

                $partnerships = array();

                foreach ($partnershipGroupsRawData->data->_embedded->partnership_group as $partnershipGroup) {
                    if ($partnershipGroup->isDefault === "1") {
                        $partnerships = $partnershipGroup->associationPartnerships;
                    }
                }
                
                if(empty($partnerships)) {
                    $this->logger->debug('Partnership group empty, get list.');
                    $partnerships = $this->charityAPIFacade->getPartnerships()->data->_embedded->partnership;
                }

            } catch (ResponseHTTPError $exception) {
                if ($exception->getCode() === 404) {
                    $partnerships = $this->charityAPIFacade->getPartnerships()->data->_embedded->partnership;
                } else {
                    throw $exception;
                }
            }

            $this->storePartnerships($partnerships);
        } else {
            $this->logger->debug('Partnerships loaded from cache.');
        }

        return $this->orderPartnerships($partnerships);
    }

    /**
     * @param array $partnerships
     * @return void
     * @throws Exception
     */
    private function storePartnerships($partnerships)
    {
        $this->cacheHandler->saveEntry(self::CHARITY_PARTNERSHIP_CACHE_KEY, $partnerships);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function refreshPartnerships()
    {
        $this->cacheHandler->clearCacheEntry(self::CHARITY_PARTNERSHIP_CACHE_KEY);
    }

    /**
     * @param array $partnerships
     * @return array
     * @throws Exception
     */
    private function orderPartnerships($partnerships)
    {
        $partnershipsPositions = $this->settings->get('charity_partnerships_positions');

        if (!empty($partnershipsPositions)) {
            foreach ($partnerships as $partnership) {
                if (in_array($partnership->idPartnership, $partnershipsPositions)) {
                    $partnership->position = array_search($partnership->idPartnership, $partnershipsPositions);
                } else {
                    $partnership->position = null;
                }
            }

            usort($partnerships, function ($partnershipA, $partnershipB) {
                if ($partnershipA->position === $partnershipB->position) {
                    return 0;
                }
                return ($partnershipA->position < $partnershipB->position) ? -1 : 1;
            });
        }

        return $partnerships;
    }
}
