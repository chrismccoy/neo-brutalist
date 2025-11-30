<?php
/**
 * Custom template tags for this theme
 *
 * @package NeoBrutalist
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Retrieve download link meta.
 *
 * @param int $post_id
 * @return string
 */
function neo_get_product_download_link(int $post_id): string
{
    return (string) get_post_meta($post_id, '_product_download_url', true);
}

/**
 * Custom numeric pagination.
 *
 * @return void
 */
function neo_pagination(): void
{
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;

    if ($total_pages <= 1) {
        return;
    }

    $current_page = max(1, get_query_var('paged'));

    echo '<nav class="flex items-center justify-center gap-2 mt-12 font-mono" aria-label="Pagination">';

    // Prev Button
    if ($current_page > 1) {
        printf(
            '<a href="%s" class="px-4 py-2 border-2 border-slate-900 bg-white text-slate-900 font-bold hover:bg-cyan-400 uppercase transition-colors">%s</a>',
            esc_url(get_pagenum_link($current_page - 1)),
            esc_html__('Prev', 'neo-brutalist')
        );
    } else {
        echo '<button disabled class="px-4 py-2 border-2 border-slate-900 bg-slate-300 text-slate-500 font-bold uppercase cursor-not-allowed">' . esc_html__('Prev', 'neo-brutalist') . '</button>';
    }

    // Numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            printf(
                '<span aria-current="page" class="w-10 h-10 flex items-center justify-center border-2 border-slate-900 bg-fuchsia-500 text-white font-bold brutalist-shadow-sm">%d</span>',
                (int) $i
            );
        } else {
            printf(
                '<a href="%s" class="w-10 h-10 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-900 font-bold hover:bg-cyan-400 transition-colors">%d</a>',
                esc_url(get_pagenum_link($i)),
                (int) $i
            );
        }
    }

    // Next Button
    if ($current_page < $total_pages) {
        printf(
            '<a href="%s" class="px-4 py-2 border-2 border-slate-900 bg-white text-slate-900 font-bold hover:bg-cyan-400 uppercase transition-colors">%s</a>',
            esc_url(get_pagenum_link($current_page + 1)),
            esc_html__('Next', 'neo-brutalist')
        );
    } else {
        echo '<button disabled class="px-4 py-2 border-2 border-slate-900 bg-slate-300 text-slate-500 font-bold uppercase cursor-not-allowed">' . esc_html__('Next', 'neo-brutalist') . '</button>';
    }

    echo '</nav>';
}

/**
 * Display the post content without the first gallery.
 *
 * This is used in single.php because the gallery is extracted to display
 * it in the "Neo-Brutalist" hero section. This is to avoid it appearing twice.
 *
 * @return void
 */
function neo_the_content_without_gallery(): void
{
    $content = get_the_content();

    // Handle Gallery Blocks
    if (has_block('core/gallery', $content)) {
        // Match the first gallery block and remove it
        $content = preg_replace(
            '/<!-- wp:gallery {.*?} -->.*?<!-- \/wp:gallery -->/s',
            '',
            $content,
            1
        );
    }

    // Handle Classic Shortcode Galleries
    // Only remove the shortcode if it hasnt been stripped
    if (has_shortcode($content, 'gallery')) {
        global $shortcode_tags;

        // Backup all shortcodes
        $stack = $shortcode_tags;

        // Remove only the gallery shortcode temporarily
        // so strip_shortcodes() only targets [gallery]
        $shortcode_tags = ['gallery' => 1];

        $content = strip_shortcodes($content);

        // Restore all shortcodes
        $shortcode_tags = $stack;
    }

    // Apply standard WordPress content filters
    echo apply_filters('the_content', $content);
}
