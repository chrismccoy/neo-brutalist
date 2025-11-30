<?php
/**
 * The header for the theme
 *
 * This is the template that displays all of the <head> section
 * and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-slate-200 text-slate-900 font-mono antialiased'); ?>>

<?php
// Backwards compatibility for WP 5.2+
if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>

<!-- Skip to content for accessibility -->
<a class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:top-4 focus:left-4 bg-fuchsia-500 text-white px-4 py-2 border-2 border-slate-900 font-bold uppercase" href="#main-content">
    <?php esc_html_e('Skip to content', 'neo-brutalist'); ?>
</a>

<!-- Main Layout Wrapper -->
<div class="flex min-h-screen">

    <?php get_sidebar(); ?>

    <!-- Content Column Wrapper -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Site Header -->
        <header class="sticky top-0 z-40 bg-white border-b-2 border-slate-900 font-mono transition-all" role="banner">

            <div class="container mx-auto flex items-center justify-between p-4">

                <!-- Logo & Nav Area -->
                <div class="flex items-center gap-8">

                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-extrabold text-slate-900 uppercase flex items-center" rel="home">
                        <i class="fa-solid fa-biohazard text-cyan-400 mr-2" aria-hidden="true"></i>
                        <span><?php bloginfo('name'); ?></span>
                    </a>

                    <?php if (has_nav_menu('primary')) : ?>
                        <nav class="hidden md:flex items-center gap-6" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'neo-brutalist'); ?>">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'menu_class'     => 'flex items-center gap-6',
                                'container'      => false,
                                'fallback_cb'    => false,
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            ]);
                            ?>
                        </nav>
                    <?php else : ?>
                        <!-- Fallback / Static Nav for Demo -->
                        <nav class="hidden md:flex items-center gap-6">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-900 font-bold hover:text-fuchsia-500 transition-colors">
                                <i class="fa-solid fa-house mr-1" aria-hidden="true"></i>
                                <?php esc_html_e('Home', 'neo-brutalist'); ?>
                            </a>
                        </nav>
                    <?php endif; ?>
                </div>

                <!-- Search Area -->
                <div class="hidden sm:block w-40 md:w-64">
                    <?php get_search_form(); ?>
                </div>

            </div>
        </header>

        <!-- Main Content Anchor -->
        <div id="main-content"></div>
