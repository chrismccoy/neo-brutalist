<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

?>

<aside class="w-64 bg-slate-100 text-slate-900 h-screen sticky top-0 flex-col justify-between p-6 hidden lg:flex border-r-2 border-slate-900 font-mono overflow-y-auto" role="complementary" aria-label="<?php esc_attr_e('Sidebar', 'neo-brutalist'); ?>">

    <!-- Navigation Section -->
    <div class="w-full">
        <h2 class="text-xl font-bold border-b-2 border-slate-900 pb-4 mb-6 uppercase">
            <?php esc_html_e('Browse', 'neo-brutalist'); ?>
        </h2>

        <nav aria-label="<?php esc_attr_e('Category Navigation', 'neo-brutalist'); ?>">
            <ul class="space-y-2">
                <!-- All Templates Link -->
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 p-2 hover:bg-cyan-400 transition-colors border-2 border-transparent hover:border-slate-900 group">
                        <i class="fa-solid fa-layer-group w-5 text-center text-slate-500 group-hover:text-slate-900 transition-colors" aria-hidden="true"></i>
                        <span class="font-bold uppercase text-sm group-hover:text-slate-900 transition-colors">
                            <?php esc_html_e('All Templates', 'neo-brutalist'); ?>
                        </span>
                    </a>
                </li>

                <li class="my-4 border-t-2 border-slate-300" role="separator"></li>
                <?php
                /**
                 * Retrieve Categories.
                 */
                $categories = get_categories([
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                ]);

                if (!empty($categories) && !is_wp_error($categories)) :
                    foreach ($categories as $cat) :
                        $icon_class = 'fa-solid fa-folder';
                        // Check if this is the current category to highlight it.
                        $is_active = (is_category() && get_queried_object_id() === $cat->term_id);
                        $active_classes = $is_active ? 'bg-cyan-400 border-slate-900 hover:border-slate-900' : 'border-transparent hover:bg-cyan-400 hover:border-slate-900';
                        ?>
                        <li>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="flex items-center gap-3 p-2 transition-colors border-2 group <?php echo esc_attr($active_classes); ?>">
                                <i class="<?php echo esc_attr($icon_class); ?> w-5 text-center text-slate-500 group-hover:text-slate-900 transition-colors" aria-hidden="true"></i>
                                <span class="font-bold uppercase text-sm group-hover:text-slate-900 transition-colors">
                                    <?php echo esc_html($cat->name); ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach;
                else : ?>
                    <li>
                        <span class="text-xs text-slate-400 font-bold uppercase italic p-2">
                            <?php esc_html_e('No categories found.', 'neo-brutalist'); ?>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Admin / System Section -->
    <?php if (current_user_can('manage_options')) : ?>
        <div class="mt-auto pt-6">
            <h2 class="text-xl font-bold border-b-2 border-slate-900 pb-4 mb-6 uppercase">
                <?php esc_html_e('System', 'neo-brutalist'); ?>
            </h2>
            <ul class="space-y-2">
                <li>
                    <a href="<?php echo esc_url(admin_url()); ?>" class="flex items-center gap-3 p-2 hover:bg-fuchsia-500 hover:text-white transition-colors border-2 border-transparent hover:border-slate-900 group">
                        <i class="fa-solid fa-lock w-5 text-center group-hover:text-white transition-colors" aria-hidden="true"></i>
                        <span class="font-bold uppercase text-sm">
                            <?php esc_html_e('WP Admin', 'neo-brutalist'); ?>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Copyright / Footer for Sidebar -->
    <div class="text-xs text-slate-500 mt-8 font-bold">
        <p>
            &copy; <?php echo esc_html(date('Y')); ?> 
            <?php esc_html_e('Free Templates', 'neo-brutalist'); ?>
        </p>
    </div>

</aside>
