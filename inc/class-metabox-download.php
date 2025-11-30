<?php
/**
 * Download Metabox Handler
 *
 * @package NeoBrutalist
 */
declare(strict_types=1);

namespace NeoBrutalist\Inc;

if (!defined('ABSPATH')) {
    exit;
}

class Metabox_Download
{
    private const NONCE_ACTION = 'neo_save_download_data';
    private const NONCE_NAME = 'neo_download_nonce';
    private const META_KEY = '_product_download_url';

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta_box']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    /**
     * Enqueue media scripts and custom JS for the admin area.
     */
    public function enqueue_admin_scripts($hook): void
    {
        // Only load on post edit screens
        if ('post.php' !== $hook && 'post-new.php' !== $hook) {
            return;
        }

        // Enqueue native WordPress media manager
        wp_enqueue_media();

        // Enqueue the custom admin script
        wp_enqueue_script(
            'neo-admin-js',
            NEO_URI . '/assets/js/admin.js',
            ['jquery'],
            NEO_VERSION,
            true
        );
    }

    /**
     * Register the meta box.
     */
    public function add_meta_box(): void
    {
        add_meta_box(
            'neo_download_details',
            __('Download Configuration', 'neo-brutalist'),
            [$this, 'render_meta_box'],
            'post',
            'side',
            'high'
        );
    }

    /**
     * Render the meta box content.
     */
    public function render_meta_box(\WP_Post $post): void
    {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE_ACTION, self::NONCE_NAME);
        ?>
        <div style="margin-top: 10px;">
            <label for="neo_download_url" style="font-weight:bold; display:block; margin-bottom:5px;">
                <?php esc_html_e('Download File', 'neo-brutalist'); ?>
            </label>

            <div style="display: flex; gap: 5px;">
                <input
                    type="text"
                    id="neo_download_url"
                    name="neo_download_url"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="https://..."
                    style="width:100%; padding: 5px;"
                >
                <button type="button" class="button" id="neo_upload_btn">
                    <?php esc_html_e('Select', 'neo-brutalist'); ?>
                </button>
            </div>

            <p class="description" style="margin-top:8px; font-size: 12px; color: #666;">
                <?php esc_html_e('Enter URL or select a file from the Media Library.', 'neo-brutalist'); ?>
            </p>

            <?php if ($value): ?>
                <p style="margin-top: 5px;">
                    <a href="#" id="neo_clear_btn" style="color: #b32d2e; text-decoration: none; font-size: 12px;">
                        <?php esc_html_e('Remove Link', 'neo-brutalist'); ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Save the meta box data.
     */
    public function save_meta_box(int $post_id): void
    {
        if (!isset($_POST[self::NONCE_NAME]) || !wp_verify_nonce($_POST[self::NONCE_NAME], self::NONCE_ACTION)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['neo_download_url'])) {
            $clean_url = esc_url_raw($_POST['neo_download_url']);

            if (!empty($clean_url)) {
                update_post_meta($post_id, self::META_KEY, $clean_url);
            } else {
                delete_post_meta($post_id, self::META_KEY);
            }
        }
    }
}
