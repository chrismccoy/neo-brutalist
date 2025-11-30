<?php
/**
 * Neo Brutalist Theme Functions and Definitions
 *
 * @package NeoBrutalist
 * @since 1.0.0
 */

declare(strict_types=1);

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

define('NEO_VERSION', '1.0.0');
define('NEO_DIR', get_template_directory());
define('NEO_URI', get_template_directory_uri());

// Theme Setup
require_once NEO_DIR . '/inc/class-theme-setup.php';

// Asset Management
require_once NEO_DIR . '/inc/class-assets.php';

// Metabox for the Download
require_once NEO_DIR . '/inc/class-metabox-download.php';

// Post Data Helper
require_once NEO_DIR . '/inc/class-post-data.php';

// Helper functions
require_once NEO_DIR . '/inc/template-tags.php';

// Basic theme setup
new \NeoBrutalist\Inc\Theme_Setup();

// Styles and scripts
new \NeoBrutalist\Inc\Assets();

// Post Metaboxes
new \NeoBrutalist\Inc\Metabox_Download();
