<?php
/**
 * General Archive Template (Fallback)
 *
 * This template acts as the catch-all for any archive page that does not
 * have a more specific template (like category.php, tag.php, author.php, date.php).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

get_header(); ?>

<main class="p-4 md:p-8 flex-1">

    <!-- Breadcrumbs -->
    <div class="mb-6 text-sm font-bold uppercase flex gap-2 items-center">
        <a href="<?php echo esc_url(home_url()); ?>" class="hover:text-cyan-500">
            <i class="fa-solid fa-house" aria-hidden="true"></i>
        </a>
        <span class="text-slate-400" aria-hidden="true">/</span>
        <span class="text-slate-500"><?php esc_html_e('Archives', 'neo-brutalist'); ?></span>
    </div>

    <!-- Generic Header -->
    <header class="mb-8 border-b-2 border-slate-900 pb-8 flex items-center gap-4">

        <!-- Default Branding: Slate Grey -->
        <div class="w-16 h-16 bg-slate-400 text-slate-900 flex items-center justify-center border-2 border-slate-900 brutalist-shadow-sm text-3xl">
            <i class="fa-solid fa-box-archive" aria-hidden="true"></i>
        </div>

        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 uppercase leading-none">
                <?php the_archive_title(); ?>
            </h1>

            <?php if (get_the_archive_description()) : ?>
                <div class="text-slate-600 font-bold mt-1 max-w-2xl">
                    <?php the_archive_description(); ?>
                </div>
            <?php else : ?>
                <p class="text-slate-600 font-bold mt-1">
                    <?php esc_html_e('Archive Collection', 'neo-brutalist'); ?>
                </p>
            <?php endif; ?>
        </div>
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
                    <?php esc_html_e('No Items Found', 'neo-brutalist'); ?>
                </h3>
                <p class="text-slate-500 font-bold">
                    <?php esc_html_e('This archive appears to be empty.', 'neo-brutalist'); ?>
                </p>
            </div>

        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php neo_pagination(); ?>

</main>

<?php get_footer(); ?>
