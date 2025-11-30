<?php
/**
 * Author Archive Template
 *
 * @package NeoBrutalist
 */

declare(strict_types=1);

get_header();

// Get the current author object to access meta data
$author = (get_queried_object() instanceof WP_User) ? get_queried_object() : null;
?>

<main class="p-4 md:p-8 flex-1">

    <!-- Breadcrumbs -->
    <div class="mb-6 text-sm font-bold uppercase flex gap-2 items-center">
        <a href="<?php echo esc_url(home_url()); ?>" class="hover:text-cyan-500">
            <i class="fa-solid fa-house" aria-hidden="true"></i>
        </a>
        <span class="text-slate-400" aria-hidden="true">/</span>
        <span class="text-slate-500"><?php esc_html_e('Author', 'neo-brutalist'); ?></span>
        <span class="text-slate-400" aria-hidden="true">/</span>
        <span class="text-yellow-600">
            <?php echo esc_html($author ? $author->display_name : get_the_author()); ?>
        </span>
    </div>

    <!-- Author Header -->
    <header class="mb-8 border-b-2 border-slate-900 pb-8 flex items-center gap-4">

        <!-- Icon / Avatar -->
        <div class="w-16 h-16 bg-yellow-400 text-slate-900 flex items-center justify-center border-2 border-slate-900 brutalist-shadow-sm text-3xl overflow-hidden">
            <?php if ($author) : ?>
                <?php echo get_avatar($author->ID, 64, '', '', ['class' => 'w-full h-full object-cover']); ?>
            <?php else : ?>
                <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
            <?php endif; ?>
        </div>

        <!-- Title & Bio -->
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 uppercase leading-none">
                <?php echo esc_html($author ? $author->display_name : get_the_author()); ?>
            </h1>

            <?php if ($author && get_the_author_meta('description', $author->ID)) : ?>
                <div class="text-slate-600 font-bold mt-1 max-w-2xl">
                    <?php echo wp_kses_post(get_the_author_meta('description', $author->ID)); ?>
                </div>
            <?php else : ?>
                <p class="text-slate-600 font-bold mt-1">
                    <?php
                    printf(
                        /* translators: %s: Author name */
                        esc_html__('All posts by %s', 'neo-brutalist'),
                        esc_html($author ? $author->display_name : get_the_author())
                    );
                    ?>
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
                    <?php esc_html_e('No Posts Found', 'neo-brutalist'); ?>
                </h3>
                <p class="text-slate-500 font-bold">
                    <?php esc_html_e('This author has not published any posts yet.', 'neo-brutalist'); ?>
                </p>
            </div>

        <?php endif; ?>
    </div>

    <?php neo_pagination(); ?>
</main>

<?php get_footer(); ?>
