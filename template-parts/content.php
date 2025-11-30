<?php
/**
 * Template part for displaying posts
 *
 * @package NeoBrutalist
 */

// Fetch the custom download URL using our helper function
$download_url = neo_get_product_download_link(get_the_ID());

// Get the post slug for the "browser bar" effect
$post_slug = get_post_field('post_name', get_the_ID());

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white border-2 border-slate-900 brutalist-shadow-dark transition-transform hover:-translate-x-1 hover:-translate-y-1 flex flex-col h-full group'); ?>>

    <!-- Browser Window Header -->
    <div class="relative border-b-2 border-slate-900">
        <div class="h-8 bg-slate-100 border-b-2 border-slate-900 flex items-center px-3 gap-2" aria-hidden="true">
            <div class="w-3 h-3 rounded-full bg-red-400 border-2 border-slate-900"></div>
            <div class="w-3 h-3 rounded-full bg-amber-400 border-2 border-slate-900"></div>
            <div class="w-3 h-3 rounded-full bg-green-400 border-2 border-slate-900"></div>

            <!-- Address Bar -->
            <div class="flex-1 h-5 bg-white border-2 border-slate-900 rounded-sm ml-2 flex items-center px-2">
                <span class="text-[10px] text-slate-400 font-bold truncate font-mono">
                    download://<?php echo esc_html($post_slug); ?>
                </span>
            </div>
        </div>

        <!-- Thumbnail / Image Area -->
        <div class="w-full h-64 bg-slate-100 flex items-center justify-center overflow-hidden relative">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover object-top']); ?>
            <?php else : ?>
                <div class="text-slate-300 text-6xl" aria-hidden="true">
                    <i class="fa-solid fa-image"></i>
                </div>
            <?php endif; ?>

            <!-- Hover Actions -->
            <div class="absolute inset-0 bg-slate-900/90 flex items-center justify-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <a href="<?php the_permalink(); ?>" class="bg-fuchsia-500 text-white px-4 py-2 border-2 border-slate-900 font-bold hover:bg-fuchsia-600 transition-colors brutalist-shadow-sm uppercase text-xs sm:text-sm flex items-center">
                    <i class="fa-solid fa-eye mr-2" aria-hidden="true"></i>
                    <?php esc_html_e('Details', 'neo-brutalist'); ?>
                </a>

                <?php if ($download_url) : ?>
                    <a href="<?php echo esc_url($download_url); ?>" target="_blank" rel="nofollow noopener noreferrer" class="bg-cyan-400 text-slate-900 px-4 py-2 border-2 border-slate-900 font-bold hover:bg-cyan-500 transition-colors brutalist-shadow-sm uppercase text-xs sm:text-sm flex items-center">
                        <i class="fa-solid fa-download mr-2" aria-hidden="true"></i>
                        <?php esc_html_e('Download', 'neo-brutalist'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="p-4 flex-1 flex flex-col justify-between">

        <!-- Header: Title + Date -->
        <div class="mb-4 flex justify-between items-start gap-4">
            <h3 class="text-xl font-bold uppercase leading-tight">
                <a href="<?php the_permalink(); ?>" class="hover:text-fuchsia-600 transition-colors border-b-2 border-transparent hover:border-fuchsia-600">
                    <?php the_title(); ?>
                </a>
            </h3>

            <!-- Date Badge -->
            <span class="shrink-0 bg-slate-200 text-slate-900 px-1.5 py-0.5 text-[10px] font-bold uppercase border border-slate-900 whitespace-nowrap">
                <?php echo esc_html(get_the_date('m/d/Y')); ?>
            </span>
        </div>

        <!-- Footer: Categories + Tags -->
        <div class="mt-auto border-t-2 border-slate-100 pt-3 flex items-start justify-between gap-4">

            <div class="truncate max-w-[40%] pt-0.5">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) : ?>
                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="flex items-center gap-2 text-xs font-bold uppercase text-slate-500 hover:text-cyan-600 transition-colors truncate">
                        <i class="fa-solid fa-folder" aria-hidden="true"></i>
                        <span class="truncate"><?php echo esc_html($categories[0]->name); ?></span>
                    </a>
                <?php else : ?>
                    <span class="text-xs font-bold uppercase text-slate-300"><?php esc_html_e('Uncategorized', 'neo-brutalist'); ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-wrap justify-end gap-1 max-w-[60%]">
                <?php
                $tags = get_the_tags();
                if ($tags) :
                    foreach (array_slice($tags, 0, 4) as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="bg-lime-300 text-slate-900 px-1.5 py-0.5 text-[10px] font-bold uppercase border border-slate-900 hover:bg-lime-400 transition-colors">
                            #<?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</article>
