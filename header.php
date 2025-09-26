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
        <button class="hamburger-menu-toggle" id="hamburger-toggle" aria-label="Toggle navigation menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay" id="mobile-menu-overlay">
            <div class="mobile-menu-content">
                <button class="mobile-menu-close" id="mobile-menu-close" aria-label="Close menu">×</button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-nav-links',
                    'container'      => false,
                    'fallback_cb'    => 'unlocking_newyork_fallback_menu',
                ));
                ?>
            </div>
        </div>
        
        <!-- Desktop Navigation -->
        <div class="desktop-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'desktop-nav-links',
                'container'      => false,
                'fallback_cb'    => 'unlocking_newyork_fallback_menu',
            ));
            ?>
        </div>
    </nav>
</header>

<?php
/**
 * Fallback menu if no menu is assigned
 */
function unlocking_newyork_fallback_menu($args = array()) {
    $menu_items = array(
        array('label' => 'Echos of Erie',    'url' => home_url('/')),
        array('label' => 'Profiles & People', 'url' => home_url('/profiles')),
        array('label' => 'Arts & Culture',    'url' => home_url('/arts-culture')),
        array('label' => 'Sports & Rec',      'url' => home_url('/sports')),
        array('label' => 'Canal Keepers',     'url' => home_url('/canal-keepers')),
        array('label' => 'About',             'url' => home_url('/about')),
    );

    $menu_class = isset($args['menu_class']) && $args['menu_class']
        ? ' class="' . esc_attr($args['menu_class']) . '"'
        : '';

    $menu_id = isset($args['menu_id']) && $args['menu_id']
        ? ' id="' . esc_attr($args['menu_id']) . '"'
        : '';

    echo '<ul' . $menu_id . $menu_class . '>';

    foreach ($menu_items as $item) {
        echo '<li class="menu-item">';
        echo '<a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a>';
        echo '</li>';
    }

    echo '</ul>';
}
?>
