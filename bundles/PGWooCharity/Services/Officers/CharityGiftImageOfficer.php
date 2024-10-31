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

namespace PGI\Impact\PGWooCharity\Services\Officers;

use Exception;
use PGI\Impact\PGLog\Interfaces\LoggerInterface;
use PGI\Impact\PGShop\Interfaces\Entities\ProductEntityInterface;
use PGI\Impact\PGSystem\Components\Parameters;
use PGI\Impact\PGSystem\Services\Pathfinder;
use WC_Product as LocalWC_Product;
use WP_Post as LocalWP_Post;

/**
 * Class CharityGiftImageOfficer
 * @package PGWooCharity\Services\Officers
 */
class CharityGiftImageOfficer
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
     * @param ProductEntityInterface $gift
     * @throws Exception
     * @return void
     */
    public function install(ProductEntityInterface $gift)
    {
        $this->logger->debug('Install charity gift image.');

        $imagePath = $this->pathfinder->toAbsolutePath($this->parameters['data.charity_gift.image_path']);

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
                    'post_parent' => $gift->id(),
                    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attachment_id = wp_insert_attachment($attachment, $uploadImage['file'], $gift->id());

                $gift->getLocalEntity()->set_image_id($attachment_id);
                $gift->getLocalEntity()->save();

                if (!is_wp_error($attachment_id)) {
                    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $uploadImage['file']);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                }
            }
        } catch (Exception $exception) {
            $this->logger->error('An error occurred while adding gift product image.', $exception);
        }
    }

    /**
     * @param ProductEntityInterface $gift
     * @return void
     * @throws Exception
     */
    public function associate(ProductEntityInterface $gift)
    {
        $this->logger->debug("Associate charity gift image to the gift product '{$gift->id()}'");

        $gift->getLocalEntity()->set_image_id($this->getGiftImageId($gift));
        $gift->getLocalEntity()->save();
    }

    /**
     * @param ProductEntityInterface $gift
     * @return bool
     */
    public function hasAssociatedImage(ProductEntityInterface $gift)
    {
        $hasAssociatedImage = false;

        $imageId = $this->getGiftImageId($gift);

        if ($imageId !== null) {
            /** @var LocalWC_Product $localProduct */
            $localProduct = wc_get_product($gift->id());

            $localImageId = $localProduct->get_image_id();

            if (!empty($localImageId)) {
                $hasAssociatedImage = true;
            }
        }

        return $hasAssociatedImage;
    }

    /**
     * @param ProductEntityInterface $gift
     * @return int|null
     */
    public function getGiftImageId(ProductEntityInterface $gift)
    {
        $imageId = null;

        $localImage = get_posts(array(
            'post_type' => 'attachment',
            'post_parent' => $gift->id()
        ));

        if (!empty($localImage)) {
            /** @var LocalWP_Post $localImage */
            $localImage = $localImage[0];

            $imageId = $localImage->ID;
        }

        return $imageId;
    }
}