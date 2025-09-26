<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="header">
    <!-- The Newshouse Bar -->
    <div class="newshouse-bar">
        <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/newshouse-logo.png" 
             alt="The Newshouse" class="newshouse-logo">
    </div>
    
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo-container">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/unlocking-logo.png" 
                     alt="<?php bloginfo('name'); ?>" class="main-logo">
            <?php endif; ?>
        </div>
        
        <!-- Hamburger Menu Button -->
        <button class="hamburger" id="hamburger">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'nav-links',
            'menu_class'     => 'nav-links',
            'container'      => false,
            'fallback_cb'    => 'unlocking_newyork_fallback_menu',
        ));
        ?>
    </nav>
</header>

<?php
/**
 * Fallback menu if no menu is assigned
 */
function unlocking_newyork_fallback_menu() {
    echo '<ul class="nav-links" id="nav-links">';
    echo '<button class="close-menu" id="close-menu">×</button>';
    echo '<li><a href="' . home_url('/') . '" class="nav-link">Home</a></li>';
    echo '<li><a href="' . home_url('/about') . '" class="nav-link">About</a></li>';
    echo '<li><a href="' . home_url('/contact') . '" class="nav-link">Contact</a></li>';
    echo '</ul>';
}
?>