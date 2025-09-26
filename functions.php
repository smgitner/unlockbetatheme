<?php
/**
 * Unlocking New York Theme Functions
 * 
 * @package Unlocking_NY
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function unlocking_ny_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_theme_support('html5', array(
        'search-form',
        'comment-form', 
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('post-formats', array(
        'aside',
        'image', 
        'video',
        'quote',
        'link',
        'gallery',
        'audio'
    ));
    
    // Add custom image sizes
    add_image_size('unlocking-featured', 800, 450, true);
    add_image_size('unlocking-thumbnail', 300, 200, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'unlocking-ny'),
        'footer'  => __('Footer Menu', 'unlocking-ny'),
        'social'  => __('Social Menu', 'unlocking-ny'),
    ));
    
    // Load theme textdomain
    load_theme_textdomain('unlocking-ny', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'unlocking_ny_setup');

/**
 * Enqueue scripts and styles
 */
function unlocking_ny_scripts() {
    // CSS
    wp_enqueue_style('unlocking-ny-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // JavaScript
    wp_enqueue_script('unlocking-ny-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'unlocking_ny_scripts');

/**
 * Register widget areas
 */
function unlocking_ny_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'unlocking-ny'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar for posts and pages', 'unlocking-ny'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'unlocking-ny'),
        'id'            => 'footer-widgets',
        'description'   => __('Footer widget area', 'unlocking-ny'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'unlocking_ny_widgets_init');

/**
 * Customizer additions
 */
function unlocking_ny_customize_register($wp_customize) {
    // Theme Options Section
    $wp_customize->add_section('unlocking_theme_options', array(
        'title'    => __('Theme Options', 'unlocking-ny'),
        'priority' => 30,
    ));
    
    // Social Media Links
    $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube');
    foreach ($social_networks as $network) {
        $wp_customize->add_setting("unlocking_{$network}_url", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control("unlocking_{$network}_url", array(
            'label'   => sprintf(__('%s URL', 'unlocking-ny'), ucfirst($network)),
            'section' => 'unlocking_theme_options',
            'type'    => 'url',
        ));
    }
    
    // Footer Copyright Text
    $wp_customize->add_setting('unlocking_footer_text', array(
        'default'           => '© 2025 Copyright Syracuse University.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('unlocking_footer_text', array(
        'label'   => __('Footer Copyright Text', 'unlocking-ny'),
        'section' => 'unlocking_theme_options',
        'type'    => 'text',
    ));
    
    // Show/Hide Elements
    $wp_customize->add_setting('show_sidebar', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('show_sidebar', array(
        'label'   => __('Show Sidebar', 'unlocking-ny'),
        'section' => 'unlocking_theme_options',
        'type'    => 'checkbox',
    ));
}
add_action('customize_register', 'unlocking_ny_customize_register');

/**
 * Helper function to get social media URL
 */
function unlocking_get_social_url($network) {
    return get_theme_mod("unlocking_{$network}_url", '');
}

/**
 * Custom excerpt length
 */
function unlocking_ny_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'unlocking_ny_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function unlocking_ny_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'unlocking_ny_excerpt_more');

/**
 * Posted on function
 */
function unlocking_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }
    
    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );
    
    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'unlocking-ny'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );
    
    echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Posted by function
 */
function unlocking_posted_by() {
    $byline = sprintf(
        esc_html_x('by %s', 'post author', 'unlocking-ny'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );
    
    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Entry footer function
 */
function unlocking_entry_footer() {
    // Hide category and tag text for pages
    if ('post' === get_post_type()) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(esc_html__(', ', 'unlocking-ny'));
        if ($categories_list) {
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'unlocking-ny') . '</span>', $categories_list);
        }
        
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'unlocking-ny'));
        if ($tags_list) {
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'unlocking-ny') . '</span>', $tags_list);
        }
    }
    
    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'unlocking-ny'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );
        echo '</span>';
    }
    
    edit_post_link(
        sprintf(
            wp_kses(
                __('Edit <span class="screen-reader-text">%s</span>', 'unlocking-ny'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Add mobile menu toggle functionality
 */
function unlocking_ny_nav_menu_args($args) {
    if ('primary' === $args['theme_location']) {
        $args['menu_class'] .= ' nav-menu';
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'unlocking_ny_nav_menu_args');

/**
 * Add body classes
 */
function unlocking_ny_body_classes($classes) {
    // Add class of hfeed to non-singular pages
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1') && get_theme_mod('show_sidebar', true)) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'unlocking_ny_body_classes');

/**
 * Add pingback url auto-discovery header for single posts and pages
 */
function unlocking_ny_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'unlocking_ny_pingback_header');

/**
 * Custom comment walker
 */
class Unlocking_NY_Walker_Comment extends Walker_Comment {
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '<ol class="children">' . "\n";
    }
    
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= "</ol><!-- .children -->\n";
    }
    
    public function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        
        if (!empty($args['callback'])) {
            ob_start();
            call_user_func($args['callback'], $comment, $args, $depth);
            $output .= ob_get_clean();
            return;
        }
        
        if (($comment->comment_type == 'pingback') || ($comment->comment_type == 'trackback')) {
            $output .= '<li class="pingback">';
            $output .= '<p>' . __('Pingback:', 'unlocking-ny') . ' ' . get_comment_author_link() . ' ' . get_edit_comment_link(__('Edit', 'unlocking-ny'), '<span class="edit-link">', '</span>') . '</p>';
        } else {
            $output .= '<li ' . comment_class('', null, null, false) . ' id="comment-' . get_comment_ID() . '">';
            $output .= '<article id="div-comment-' . get_comment_ID() . '" class="comment-body">';
            $output .= '<footer class="comment-meta">';
            $output .= '<div class="comment-author vcard">';
            $output .= get_avatar($comment, 50);
            $output .= '<b class="fn">' . get_comment_author_link() . '</b>';
            $output .= '</div>';
            $output .= '<div class="comment-metadata">';
            $output .= '<a href="' . esc_url(get_comment_link($comment->comment_ID)) . '">';
            $output .= '<time datetime="' . get_comment_date('c') . '">';
            $output .= sprintf(__('%1$s at %2$s', 'unlocking-ny'), get_comment_date(), get_comment_time());
            $output .= '</time>';
            $output .= '</a>';
            $output .= get_edit_comment_link(__('Edit', 'unlocking-ny'), '<span class="edit-link">', '</span>');
            $output .= '</div>';
            $output .= '</footer>';
            
            if ($comment->comment_approved == '0') {
                $output .= '<p class="comment-awaiting-moderation">' . __('Your comment is awaiting moderation.', 'unlocking-ny') . '</p>';
            }
            
            $output .= '<div class="comment-content">';
            $output .= get_comment_text();
            $output .= '</div>';
            
            comment_reply_link(array_merge($args, array(
                'add_below' => 'div-comment',
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            )));
            
            $output .= '</article>';
        }
    }
    
    public function end_el(&$output, $comment, $depth = 0, $args = array()) {
        $output .= "</li><!-- #comment-## -->\n";
    }
}

/**
 * Custom logo setup
 */
function unlocking_ny_custom_logo_setup() {
    $defaults = array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'unlocking_ny_custom_logo_setup');

/**
 * Enable shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Remove unnecessary header info
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/**
 * Add theme support for Gutenberg
 */
function unlocking_ny_gutenberg_support() {
    // Add support for editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Primary Blue', 'unlocking-ny'),
            'slug'  => 'primary-blue',
            'color' => '#7fb3d3',
        ),
        array(
            'name'  => __('Secondary Blue', 'unlocking-ny'),
            'slug'  => 'secondary-blue',
            'color' => '#5d9cdb',
        ),
        array(
            'name'  => __('Dark Blue', 'unlocking-ny'),
            'slug'  => 'dark-blue',
            'color' => '#2c3e50',
        ),
        array(
            'name'  => __('Orange', 'unlocking-ny'),
            'slug'  => 'orange',
            'color' => '#f39c12',
        ),
        array(
            'name'  => __('Light Gray', 'unlocking-ny'),
            'slug'  => 'light-gray',
            'color' => '#f8f9fa',
        ),
    ));
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Small', 'unlocking-ny'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('Regular', 'unlocking-ny'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => __('Large', 'unlocking-ny'),
            'size' => 20,
            'slug' => 'large'
        ),
        array(
            'name' => __('Huge', 'unlocking-ny'),
            'size' => 28,
            'slug' => 'huge'
        )
    ));
    
    // Add support for wide alignment
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'unlocking_ny_gutenberg_support');

/**
 * Enqueue Gutenberg editor styles
 */
function unlocking_ny_gutenberg_editor_styles() {
    wp_enqueue_style('unlocking-ny-editor-style', get_template_directory_uri() . '/editor-style.css');
}
add_action('enqueue_block_editor_assets', 'unlocking_ny_gutenberg_editor_styles');

/**
 * Security enhancements
 */
function unlocking_ny_security() {
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
    
    // Hide login errors
    add_filter('login_errors', function() {
        return __('Login failed. Please try again.', 'unlocking-ny');
    });
    
    // Remove XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    // Disable file editing
    if (!defined('DISALLOW_FILE_EDIT')) {
        define('DISALLOW_FILE_EDIT', true);
    }
}
add_action('init', 'unlocking_ny_security');

/**
 * Performance optimizations
 */
function unlocking_ny_performance() {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // Remove query strings from static resources
    add_filter('script_loader_src', function($src) {
        if (strpos($src, '?ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    });
    
    add_filter('style_loader_src', function($src) {
        if (strpos($src, '?ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    });
}
add_action('init', 'unlocking_ny_performance');

/**
 * Custom post navigation
 */
function unlocking_ny_post_navigation() {
    the_post_navigation(array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'unlocking-ny') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'unlocking-ny') . '</span> <span class="nav-title">%title</span>',
    ));
}

/**
 * Custom posts navigation
 */
function unlocking_ny_posts_navigation() {
    the_posts_navigation(array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Older posts', 'unlocking-ny') . '</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Newer posts', 'unlocking-ny') . '</span>',
    ));
}