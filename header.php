<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'unlocking-ny'); ?></a>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="newshouse-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/newshouse-logo.png" 
                         alt="<?php esc_attr_e('The Newshouse', 'unlocking-ny'); ?>" />
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/unlocking-ny-logo.png" 
                             alt="<?php bloginfo('name'); ?>" class="site-logo" />
                    </a>
                </h1>
                <?php
                $unlocking_description = get_bloginfo('description', 'display');
                if ($unlocking_description || is_customize_preview()) :
                ?>
                    <p class="site-description screen-reader-text"><?php echo $unlocking_description; ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger"></span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'unlocking-ny'); ?></span>
                </button>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'unlocking_ny_default_menu',
                ));
                ?>
            </nav><!-- #site-navigation -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">

<?php
/**
 * Default menu fallback
 */
function unlocking_ny_default_menu() {
    echo '<ul id="primary-menu" class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'unlocking-ny') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'unlocking-ny') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'unlocking-ny') . '</a></li>';
    echo '</ul>';
}
?>