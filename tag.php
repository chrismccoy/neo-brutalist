<?php
/**
 * Tag Archive Template
 *
 * @package NeoBrutalist
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
        <span class="text-slate-500"><?php esc_html_e('Tag', 'neo-brutalist'); ?></span>
        <span class="text-slate-400" aria-hidden="true">/</span>
        <span class="text-lime-600">#<?php single_term_title(); ?></span>
    </div>

    <!-- Tag Header -->
    <header class="mb-8 border-b-2 border-slate-900 pb-8 flex items-center gap-4">
        <div class="w-16 h-16 bg-lime-400 text-slate-900 flex items-center justify-center border-2 border-slate-900 brutalist-shadow-sm text-3xl">
            <i class="fa-solid fa-hashtag" aria-hidden="true"></i>
        </div>

        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 uppercase leading-none">
                <?php single_term_title(); ?>
            </h1>

            <?php if (tag_description()) : ?>
                <div class="text-slate-600 font-bold mt-1">
                    <?php echo wp_kses_post(tag_description()); ?>
                </div>
            <?php else : ?>
                <p class="text-slate-600 font-bold mt-1">
                    <?php esc_html_e('Tag Archive', 'neo-brutalist'); ?>
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

            <div class="col-span-full border-4 border-dashed border-slate-900 p-12 text-center">
                <h3 class="text-2xl font-bold uppercase mb-2">
                    <?php esc_html_e('No Items Found', 'neo-brutalist'); ?>
                </h3>
                <p class="text-slate-500 font-bold">
                    <?php
                    printf(
                        /* translators: %s: Tag name */
                        esc_html__('No items tagged with "%s".', 'neo-brutalist'),
                        single_term_title('', false)
                    );
                    ?>
                </p>
            </div>

        <?php endif; ?>
    </div>

    <?php neo_pagination(); ?>
</main>

<?php get_footer(); ?>
