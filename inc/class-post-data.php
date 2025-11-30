<?php
/**
 * Post Data Helper Class
 *
 * Handles data retrieval and processing for single posts.
 *
 * @package NeoBrutalist
 */
declare(strict_types=1);

namespace NeoBrutalist\Inc;

if (!defined('ABSPATH')) {
    exit;
}

class Post_Data
{
    /**
     * Get all necessary view data for a single post.
     *
     * @param int $post_id The post ID.
     * @return array<string, mixed> The prepared data.
     */
    public static function get_single_view_data(int $post_id): array
    {
        return [
            'post_id'       => $post_id,
            'download_link' => self::get_download_link($post_id),
            'gallery'       => self::get_gallery_images($post_id),
            'categories'    => get_the_category($post_id),
            'tags'          => get_the_tags($post_id),
            'post_name'     => get_post_field('post_name', $post_id),
        ];
    }

    /**
     * Retrieve the download link.
     */
    private static function get_download_link(int $post_id): string
    {
        return (string) get_post_meta($post_id, '_product_download_url', true);
    }

    /**
     * Process gallery images including the featured image.
     *
     * @param int $post_id
     * @return array<int, string> List of image URLs.
     */
    private static function get_gallery_images(int $post_id): array
    {
        $images = [];

        // Add Featured Image
        $thumb_url = get_the_post_thumbnail_url($post_id, 'full');
        if ($thumb_url) {
            $images[] = $thumb_url;
        }

        // Add Gallery Images
        $gallery = get_post_gallery($post_id, false);

        if ($gallery && isset($gallery['ids'])) {
            $ids = explode(',', $gallery['ids']);
            foreach ($ids as $attachment_id) {
                $img_src = wp_get_attachment_image_src((int) $attachment_id, 'full');
                if ($img_src) {
                    $images[] = $img_src[0];
                }
            }
        }

        // Remove duplicates (in case featured image is also in gallery)
        return array_unique($images);
    }
}
