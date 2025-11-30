<?php
/**
 * Theme Setup Configuration
 *
 * @package NeoBrutalist
 */
declare(strict_types=1);

namespace NeoBrutalist\Inc;

if (!defined('ABSPATH')) {
    exit;
}

class Theme_Setup
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'setup']);
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @return void
     */
    public function setup(): void
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]);
    }
}
