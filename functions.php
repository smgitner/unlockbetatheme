<?php
/**
 * Unlocking New York Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function unlocking_newyork_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('menus');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'unlocking-newyork'),
        'footer' => __('Footer Menu', 'unlocking-newyork'),
    ));
}
add_action('after_setup_theme', 'unlocking_newyork_setup');

/**
 * Enqueue scripts and styles
 */
function unlocking_newyork_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&family=Barlow+Condensed:wght@700&display=swap', array(), null);
    
    // Enqueue main stylesheet
    wp_enqueue_style('unlocking-newyork-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue JavaScript for mobile menu
    wp_enqueue_script('unlocking-newyork-script', get_template_directory_uri() . '/js/mobile-menu.js', array(), '1.0.0', true);
    
    // Localize script for AJAX if needed
    wp_localize_script('unlocking-newyork-script', 'unlocking_newyork_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('unlocking_newyork_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'unlocking_newyork_scripts');

/**
 * Register widget areas
 */
function unlocking_newyork_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'unlocking-newyork'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'unlocking-newyork'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'unlocking_newyork_widgets_init');

/**
 * Customize excerpt length
 */
function unlocking_newyork_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'unlocking_newyork_excerpt_length');

/**
 * Customize excerpt more
 */
function unlocking_newyork_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'unlocking_newyork_excerpt_more');

/**
 * Add custom body classes
 */
function unlocking_newyork_body_classes($classes) {
    if (is_home() || is_front_page()) {
        $classes[] = 'home-page';
    }
    return $classes;
}
add_filter('body_class', 'unlocking_newyork_body_classes');

/**
 * Custom logo support
 */
function unlocking_newyork_custom_logo() {
    if (function_exists('the_custom_logo')) {
        the_custom_logo();
    }
}

/**
 * Get social media links from customizer
 */
function unlocking_newyork_get_social_links() {
    $social_links = array();
    
    $facebook = get_theme_mod('facebook_url', '');
    $instagram = get_theme_mod('instagram_url', '');
    $twitter = get_theme_mod('twitter_url', '');
    $linkedin = get_theme_mod('linkedin_url', '');
    $youtube = get_theme_mod('youtube_url', '');
    
    if ($facebook) $social_links['facebook'] = $facebook;
    if ($instagram) $social_links['instagram'] = $instagram;
    if ($twitter) $social_links['twitter'] = $twitter;
    if ($linkedin) $social_links['linkedin'] = $linkedin;
    if ($youtube) $social_links['youtube'] = $youtube;
    
    return $social_links;
}

/**
 * Add theme customizer options
 */
function unlocking_newyork_customize_register($wp_customize) {
    // Social Media Section
    $wp_customize->add_section('social_media', array(
        'title'    => __('Social Media Links', 'unlocking-newyork'),
        'priority' => 30,
    ));
    
    // Facebook URL
    $wp_customize->add_setting('facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('facebook_url', array(
        'label'   => __('Facebook URL', 'unlocking-newyork'),
        'section' => 'social_media',
        'type'    => 'url',
    ));
    
    // Instagram URL
    $wp_customize->add_setting('instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label'   => __('Instagram URL', 'unlocking-newyork'),
        'section' => 'social_media',
        'type'    => 'url',
    ));
    
    // Twitter URL
    $wp_customize->add_setting('twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('twitter_url', array(
        'label'   => __('Twitter URL', 'unlocking-newyork'),
        'section' => 'social_media',
        'type'    => 'url',
    ));
    
    // LinkedIn URL
    $wp_customize->add_setting('linkedin_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('linkedin_url', array(
        'label'   => __('LinkedIn URL', 'unlocking-newyork'),
        'section' => 'social_media',
        'type'    => 'url',
    ));
    
    // YouTube URL
    $wp_customize->add_setting('youtube_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('youtube_url', array(
        'label'   => __('YouTube URL', 'unlocking-newyork'),
        'section' => 'social_media',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'unlocking_newyork_customize_register');

/**
 * Add theme support for custom background
 */
function unlocking_newyork_custom_background() {
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
}
add_action('after_setup_theme', 'unlocking_newyork_custom_background');

/**
 * Add theme support for custom header
 */
function unlocking_newyork_custom_header() {
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width' => 1200,
        'height' => 300,
        'flex-height' => true,
        'flex-width' => true,
    ));
}
add_action('after_setup_theme', 'unlocking_newyork_custom_header');

/**
 * Add theme support for editor styles
 */
function unlocking_newyork_editor_styles() {
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');
}
add_action('after_setup_theme', 'unlocking_newyork_editor_styles');

/**
 * Add theme support for wide and full width blocks
 */
function unlocking_newyork_block_support() {
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    // Note: editor-color-palette, editor-font-sizes, and editor-gradient-presets
    // are now handled by theme.json file instead of theme support declarations
    add_theme_support('custom-spacing');
    add_theme_support('custom-line-height');
    add_theme_support('experimental-link-color');
    add_theme_support('experimental-custom-spacing');
}
add_action('after_setup_theme', 'unlocking_newyork_block_support');

/**
 * Add theme support for selective refresh for widgets
 */
function unlocking_newyork_widgets_selective_refresh() {
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'unlocking_newyork_widgets_selective_refresh');

/**
 * Fallback footer menu if no menu is assigned
 */
function unlocking_newyork_footer_fallback_menu() {
    echo '<ul class="footer-nav">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="footer-nav-link">' . __('Home', 'unlocking-newyork') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '" class="footer-nav-link">' . __('About', 'unlocking-newyork') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '" class="footer-nav-link">' . __('Contact', 'unlocking-newyork') . '</a></li>';
    echo '</ul>';
}
?>