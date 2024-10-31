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

namespace PGI\Impact\PGWooTree\Services\Officers;

use Exception;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGSystem\Components\Parameters;
use PGI\Impact\PGSystem\Services\Pathfinder;
use WC_Product as LocalWC_Product;
use WP_Post as LocalWP_Post;

/**
 * Class TreeContributionImageOfficer
 * @package PGWooTree\Services\Officers
 */
class TreeContributionImageOfficer
{
    /** @var Pathfinder */
    private $pathfinder;

    /** @var Parameters */
    private $parameters;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        Pathfinder $pathfinder,
        Parameters $parameters,
        LoggerInterface $logger
    ) {
        $this->pathfinder = $pathfinder;
        $this->parameters = $parameters;
        $this->logger = $logger;
    }

    /**
     * @param ProductEntityInterface $contribution
     * @throws Exception
     * @return void
     */
    public function install(ProductEntityInterface $contribution)
    {
        $this->logger->debug('Install tree contribution image.');

        $imagePath = $this->pathfinder->toAbsolutePath($this->parameters['data.tree_contribution.image_path']);

        try {
            $filename = basename($imagePath);

            $uploadImage = wp_upload_bits(
                $filename,
                null,
                file_get_contents($imagePath)
            );

            if (!$uploadImage['error']) {
                $wpFiletype = wp_check_filetype($filename);
                $attachment = array(
                    'post_mime_type' => $wpFiletype['type'],
                    'post_parent' => $contribution->id(),
                    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attachment_id = wp_insert_attachment($attachment, $uploadImage['file'], $contribution->id());

                $contribution->getLocalEntity()->set_image_id($attachment_id);
                $contribution->getLocalEntity()->save();

                if (!is_wp_error($attachment_id)) {
                    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $uploadImage['file']);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                }
            }
        } catch (Exception $exception) {
            $this->logger->error('An error occurred while adding contribution product image.', $exception);
        }
    }

    /**
     * @param ProductEntityInterface $contribution
     * @return void
     * @throws Exception
     */
    public function associate(ProductEntityInterface $contribution)
    {
        $this->logger->debug("Associate tree contribution image to the contribution product '{$contribution->id()}'");

        $contribution->getLocalEntity()->set_image_id($this->getContributionImageId($contribution));
        $contribution->getLocalEntity()->save();
    }

    /**
     * @param ProductEntityInterface $contribution
     * @return bool
     */
    public function hasAssociatedImage(ProductEntityInterface $contribution)
    {
        $hasAssociatedImage = false;

        $imageId = $this->getContributionImageId($contribution);

        if ($imageId !== null) {
            /** @var LocalWC_Product $localProduct */
            $localProduct = wc_get_product($contribution->id());

            $localImageId = $localProduct->get_image_id();

            if (!empty($localImageId)) {
                $hasAssociatedImage = true;
            }
        }

        return $hasAssociatedImage;
    }

    /**
     * @param ProductEntityInterface $contribution
     * @return int|null
     */
    public function getContributionImageId(ProductEntityInterface $contribution)
    {
        $imageId = null;

        $localImage = get_posts(array(
            'post_type' => 'attachment',
            'post_parent' => $contribution->id()
        ));

        if (!empty($localImage)) {
            /** @var LocalWP_Post $localImage */
            $localImage = $localImage[0];

            $imageId = $localImage->ID;
        }

        return $imageId;
    }
}