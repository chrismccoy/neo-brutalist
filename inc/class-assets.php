<?php
/**
 * Asset Management
 *
 * @package NeoBrutalist
 */
declare(strict_types=1);

namespace NeoBrutalist\Inc;

if (!defined('ABSPATH')) {
    exit;
}

class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    /**
     * Enqueue scripts and styles.
     *
     * @return void
     */
    public function register_scripts(): void
    {
        // Main Stylesheet
        wp_enqueue_style(
            'neo-brutalist-css',
            NEO_URI . '/assets/css/app.css',
            [],
            NEO_VERSION
        );

        // Font Awesome
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
            [],
            '6.5.2'
        );

        // Main JavaScript
        wp_enqueue_script(
            'neo-brutalist-js',
            NEO_URI . '/assets/js/app.js',
            [],
            NEO_VERSION,
            true
        );

    }
}
