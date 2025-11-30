<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

?>
        <!-- Close Main Content Area -->
        <footer class="bg-white border-t-2 border-slate-900 py-12 font-mono mt-auto" role="contentinfo">
            <div class="container mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-6">

                <!-- Branding Section -->
                <div class="flex flex-col gap-2">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl font-extrabold text-slate-900 uppercase">
                        <i class="fa-solid fa-biohazard text-cyan-400 mr-2" aria-hidden="true"></i>
                        <?php bloginfo('name'); ?>
                    </a>

                    <?php if (get_bloginfo('description')) : ?>
                        <p class="text-xs font-bold text-slate-500 uppercase max-w-xs">
                            <?php echo esc_html(get_bloginfo('description')); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Social Links -->
                <div class="flex gap-6">
                    <a href="#" class="w-10 h-10 flex items-center justify-center border-2 border-slate-900 bg-slate-100 hover:bg-fuchsia-500 hover:text-white transition-colors brutalist-shadow-sm" aria-label="<?php esc_attr_e('GitHub', 'neo-brutalist'); ?>">
                        <i class="fa-brands fa-github text-lg" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center border-2 border-slate-900 bg-slate-100 hover:bg-cyan-400 hover:text-slate-900 transition-colors brutalist-shadow-sm" aria-label="<?php esc_attr_e('Twitter', 'neo-brutalist'); ?>">
                        <i class="fa-brands fa-twitter text-lg" aria-hidden="true"></i>
                    </a>
                    <a href="mailto:<?php echo esc_attr(get_option('admin_email')); ?>" class="w-10 h-10 flex items-center justify-center border-2 border-slate-900 bg-slate-100 hover:bg-lime-400 hover:text-slate-900 transition-colors brutalist-shadow-sm" aria-label="<?php esc_attr_e('Email Us', 'neo-brutalist'); ?>">
                        <i class="fa-solid fa-envelope text-lg" aria-hidden="true"></i>
                    </a>
                </div>

            </div>

            <!-- Copyright / Credits -->
            <div class="text-center mt-8 pt-8 border-t-2 border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase">
                    &copy; <?php echo esc_html(date('Y')); ?> <?php esc_html_e('All Rights Reserved.', 'neo-brutalist'); ?>
                </p>
            </div>
        </footer>

    </div><!-- .flex-1 (From header.php) -->
</div><!-- .flex .min-h-screen (From header.php) -->

<?php wp_footer(); ?>

</body>
</html>
