<?php
/**
 * Single Post Template
 *
 * @package NeoBrutalist
 */
declare(strict_types=1);

use NeoBrutalist\Inc\Post_Data;

get_header();

// Fetch Prepared Data
$data = Post_Data::get_single_view_data(get_the_ID());

// Extract specific variables for usage in HTML
// Using array destructuring for clarity
[
    'download_link' => $download_link,
    'gallery'       => $gallery_images,
    'categories'    => $categories,
    'tags'          => $tags,
    'post_name'     => $post_name
] = $data;

?>

<main class="p-4 md:p-8">

    <!-- Breadcrumbs -->
    <div class="mb-6 text-sm font-bold uppercase flex gap-2 items-center flex-wrap">
        <a href="<?php echo esc_url(home_url()); ?>" class="hover:text-cyan-500">
            <i class="fa-solid fa-house" aria-hidden="true"></i>
        </a>
        <span class="text-slate-400" aria-hidden="true">/</span>

        <?php if (!empty($categories)) : ?>
            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="hover:text-cyan-500">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        <?php else: ?>
            <span class="text-slate-500"><?php esc_html_e('Uncategorized', 'neo-brutalist'); ?></span>
        <?php endif; ?>

        <span class="text-slate-400" aria-hidden="true">/</span>
        <span class="text-fuchsia-600 truncate max-w-[200px]"><?php the_title(); ?></span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12">

        <!-- Left Column: Visuals -->
        <div class="lg:col-span-3">
            <div class="bg-white border-2 border-slate-900 brutalist-shadow-dark mb-8">
                <!-- Browser Bar -->
                <div class="h-9 bg-slate-100 border-b-2 border-slate-900 flex items-center px-3 gap-2" aria-hidden="true">
                    <div class="w-3 h-3 rounded-full bg-red-400 border-2 border-slate-900"></div>
                    <div class="w-3 h-3 rounded-full bg-amber-400 border-2 border-slate-900"></div>
                    <div class="w-3 h-3 rounded-full bg-green-400 border-2 border-slate-900"></div>
                    <div class="flex-1 h-5 bg-white border-2 border-slate-900 rounded-sm ml-2 flex items-center px-2">
                        <span class="text-[10px] text-slate-400 font-bold truncate">download://<?php echo esc_html($post_name); ?></span>
                    </div>
                </div>

                <!-- Main Image -->
                <div class="w-full bg-slate-50 flex items-center justify-center overflow-hidden">
                    <?php if (!empty($gallery_images)) : ?>
                        <img src="<?php echo esc_url($gallery_images[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-auto object-cover object-top" id="main-image">
                    <?php else: ?>
                        <div class="w-full h-96 flex items-center justify-center text-slate-400 font-bold uppercase">
                            <?php esc_html_e('No Preview Available', 'neo-brutalist'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Gallery Thumbs -->
            <?php if (count($gallery_images) > 1) : ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php foreach ($gallery_images as $index => $img) : ?>
                        <a href="<?php echo esc_url($img); ?>" class="thumb-trigger block border-2 border-slate-900 bg-white p-1 hover:border-cyan-400 transition-colors">
                            <img src="<?php echo esc_url($img); ?>" alt="Thumb <?php echo (int) $index; ?>" class="w-full h-24 object-cover hover:opacity-75 transition-opacity">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column: Details -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 uppercase leading-tight"><?php the_title(); ?></h1>

                <div class="flex flex-wrap items-start gap-3 mt-6">
                    <?php if (!empty($categories)) : ?>
                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="group flex items-center gap-2 border-2 border-slate-900 bg-white px-3 py-1.5 hover:bg-slate-50 transition-colors shadow-sm">
                            <i class="fa-solid fa-folder text-fuchsia-600 group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                            <span class="font-bold uppercase text-sm"><?php echo esc_html($categories[0]->name); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ($tags) : foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="flex items-center gap-2 border-2 border-slate-900 bg-lime-300 px-3 py-1.5 hover:bg-lime-400 transition-colors text-slate-900 shadow-sm">
                            <i class="fa-solid fa-hashtag text-xs" aria-hidden="true"></i>
                            <span class="font-bold uppercase text-sm"><?php echo esc_html($tag->name); ?></span>
                        </a>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <!-- Download Button -->
            <?php if ($download_link) : ?>
                <a href="<?php echo esc_url($download_link); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-4 w-full text-center bg-fuchsia-500 text-white px-8 py-4 border-2 border-slate-900 font-bold hover:bg-fuchsia-600 transition-all hover:translate-x-1 hover:translate-y-1 brutalist-shadow-dark hover:shadow-none uppercase text-xl">
                    <i class="fa-solid fa-download" aria-hidden="true"></i>
                    <span><?php esc_html_e('Download Now', 'neo-brutalist'); ?></span>
                </a>
            <?php else : ?>
                <button disabled class="flex items-center justify-center gap-4 w-full text-center bg-slate-300 text-slate-500 px-8 py-4 border-2 border-slate-500 font-bold uppercase text-xl cursor-not-allowed">
                    <i class="fa-solid fa-ban" aria-hidden="true"></i>
                    <span><?php esc_html_e('Unavailable', 'neo-brutalist'); ?></span>
                </button>
            <?php endif; ?>

            <div class="bg-slate-100 border-2 border-slate-900 p-4 flex items-center gap-4">
                <i class="fa-solid fa-hand-holding-dollar text-2xl text-cyan-500" aria-hidden="true"></i>
                <p class="font-bold text-sm"><?php esc_html_e('Free for personal and commercial use.', 'neo-brutalist'); ?></p>
            </div>

            <!-- Content -->
            <div class="prose prose-slate font-mono prose-headings:uppercase prose-headings:font-extrabold prose-a:text-fuchsia-600">
                <?php
                // Outputs content, but strips the gallery since its used it in the header
                neo_the_content_without_gallery();
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
