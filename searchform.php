<?php
/**
 * Search Form Template
 *
 * Used for generating the search form HTML.
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

// Generate a unique ID for this form instance to allow multiple forms per page.
$unique_id = wp_unique_id('search-form-');
?>

<form role="search" method="get" class="relative w-full search-form" action="<?php echo esc_url(home_url('/')); ?>">

    <label class="sr-only" for="<?php echo esc_attr($unique_id); ?>">
        <?php esc_html_e('Search for:', 'neo-brutalist'); ?>
    </label>

    <input
        type="search"
        id="<?php echo esc_attr($unique_id); ?>"
        class="w-full px-4 py-2 border-2 border-slate-900 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 uppercase font-bold placeholder-slate-400 transition-shadow search-field"
        placeholder="<?php echo esc_attr_x('SEARCH...', 'placeholder', 'neo-brutalist'); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
        aria-label="<?php esc_attr_e('Search query', 'neo-brutalist'); ?>"
    />

    <button
        type="submit"
        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-900 transition-colors search-submit"
        aria-label="<?php esc_attr_e('Submit Search', 'neo-brutalist'); ?>"
    >
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
    </button>

</form>
