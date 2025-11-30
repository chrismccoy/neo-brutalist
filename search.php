<?php
/**
 * Search Results Template
 *
 * @package NeoBrutalist
 */

declare(strict_types=1);

get_header();

global $wp_query;
?>

<main class="p-4 md:p-8 flex-1">

    <!-- Breadcrumbs -->
    <div class="mb-6 text-sm font-bold uppercase flex gap-2 items-center">
        <a href="<?php echo esc_url(home_url()); ?>" class="hover:text-cyan-500">
            <i class="fa-solid fa-house" aria-hidden="true"></i>
        </a>
        <span class="text-slate-400" aria-hidden="true">/</span>
        <span class="text-slate-500"><?php esc_html_e('Search', 'neo-brutalist'); ?></span>
    </div>

    <!-- Header Section -->
    <header class="mb-8 border-b-2 border-slate-900 pb-8 flex items-center gap-4">
        <div class="w-16 h-16 bg-cyan-400 text-slate-900 flex items-center justify-center border-2 border-slate-900 brutalist-shadow-sm text-3xl">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </div>

        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 uppercase leading-none">
                <?php esc_html_e('Search Results', 'neo-brutalist'); ?>
            </h1>
            <p class="text-slate-600 font-bold mt-1">
                <?php
                printf(
                    /* translators: 1: Number of results, 2: Search term */
                    esc_html__('Found %1$s result(s) for "%2$s"', 'neo-brutalist'),
                    '<span class="text-fuchsia-600">' . esc_html((string) $wp_query->found_posts) . '</span>',
                    '<span class="text-slate-900 underline decoration-2 decoration-fuchsia-500">' . get_search_query() . '</span>'
                );
                ?>
            </p>
        </div>
    </header>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content'); ?>
            <?php endwhile; ?>

        <?php else : ?>

            <!-- Empty State -->
            <div class="col-span-full border-4 border-dashed border-slate-900 p-12 text-center">
                <h3 class="text-2xl font-bold uppercase mb-2">
                    <?php esc_html_e('No Results Found', 'neo-brutalist'); ?>
                </h3>
                <p class="text-slate-500 font-bold mb-4">
                    <?php
                    printf(
                        /* translators: %s: Search term */
                        esc_html__('Sorry, we couldn\'t find anything matching "%s".', 'neo-brutalist'),
                        get_search_query()
                    );
                    ?>
                </p>

                <div>
                    <a href="<?php echo esc_url(home_url()); ?>" class="inline-block bg-slate-900 text-white px-6 py-3 border-2 border-slate-900 font-bold uppercase hover:bg-cyan-400 hover:text-slate-900 transition-colors">
                        <?php esc_html_e('Return Home', 'neo-brutalist'); ?>
                    </a>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php neo_pagination(); ?>
</main>

<?php get_footer(); ?>
