<?php
/**
 * Main Template File
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

get_header(); ?>

<main class="p-4 md:p-8 flex-1">

    <!-- Hero / Header Section -->
    <header class="mb-8 border-b-2 border-slate-900 pb-8">
        <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 uppercase leading-none mb-4">
            <?php
            if (is_home() && !is_front_page()) {
                single_post_title();
            } else {
                esc_html_e('Latest Entries', 'neo-brutalist');
            }
            ?>
        </h1>

        <?php if (!is_paged() && get_bloginfo('description')) : ?>
            <p class="text-slate-600 text-lg max-w-2xl font-bold">
                <?php echo esc_html(get_bloginfo('description')); ?>
            </p>
        <?php endif; ?>
    </header>

    <!-- Post Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content'); ?>
            <?php endwhile; ?>

        <?php else : ?>

            <!-- Empty State -->
            <div class="col-span-full border-4 border-dashed border-slate-900 p-12 text-center">
                <h3 class="text-2xl font-bold uppercase mb-2">
                    <?php esc_html_e('Welcome', 'neo-brutalist'); ?>
                </h3>
                <p class="text-slate-500 font-bold">
                    <?php esc_html_e('No posts have been published yet.', 'neo-brutalist'); ?>
                </p>
            </div>

        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php neo_pagination(); ?>

</main>

<?php get_footer(); ?>
