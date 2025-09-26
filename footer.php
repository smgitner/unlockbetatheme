</div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <!-- Wave Divider -->
        <div class="wave-divider">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 Q300,0 600,60 T1200,60 L1200,120 L0,120 Z" fill="#2c3e50"/>
            </svg>
        </div>
        
        <div class="footer-content">
            <div class="container">
                <!-- Footer Logo -->
                <div class="footer-logo">
                    <div class="ship-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ship-icon.png" 
                             alt="<?php esc_attr_e('Ship Icon', 'unlocking-ny'); ?>" />
                    </div>
                    <h2><?php esc_html_e('UNLOCKING', 'unlocking-ny'); ?><br><?php esc_html_e('NEW YORK', 'unlocking-ny'); ?></h2>
                </div>
                
                <!-- Footer Navigation -->
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'fallback_cb' => 'unlocking_ny_footer_menu_fallback',
                    ));
                    ?>
                </nav>
                
                <!-- Social Media -->
                <div class="social-media">
                    <?php
                    $social_networks = array(
                        'facebook' => 'fab fa-facebook-f',
                        'instagram' => 'fab fa-instagram',
                        'twitter' => 'fab fa-x-twitter',
                        'linkedin' => 'fab fa-linkedin-in',
                        'youtube' => 'fab fa-youtube'
                    );
                    
                    foreach ($social_networks as $network => $icon) {
                        $url = unlocking_get_social_url($network);
                        if ($url) {
                            echo '<a href="' . esc_url($url) . '" class="social-link ' . esc_attr($network) . '" target="_blank" rel="noopener noreferrer">';
                            echo '<i class="' . esc_attr($icon) . '"></i>';
                            echo '<span class="screen-reader-text">' . sprintf(esc_html__('Visit our %s page', 'unlocking-ny'), ucfirst($network)) . '</span>';
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
                
                <!-- Footer Widgets -->
                <?php if (is_active_sidebar('footer-widgets')) : ?>
                    <div class="footer-widgets">
                        <?php dynamic_sidebar('footer-widgets'); ?>
                    </div>
                <?php endif; ?>
            </div><!-- .container -->
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="waer-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/waer-logo.png" 
                             alt="<?php esc_attr_e('WAER 88.3', 'unlocking-ny'); ?>" />
                    </div>
                    <div class="footer-text">
                        <p><?php echo esc_html(get_theme_mod('unlocking_footer_text', '© 2025 Copyright Syracuse University.')); ?></p>
                        <p><?php esc_html_e('The S.I. Newhouse School of Public Communications', 'unlocking-ny'); ?></p>
                        <p><?php esc_html_e('215 University Place, Syracuse, NY 13244', 'unlocking-ny'); ?></p>
                    </div>
                </div><!-- .container -->
            </div><!-- .footer-bottom -->
        </div><!-- .footer-content -->
    </footer><!-- #colophon -->
    
    <!-- Back to Top Button -->
    <button class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'unlocking-ny'); ?>">
        <i class="fas fa-arrow-up"></i>
    </button>
    
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
// Mobile menu toggle and back to top functionality
jQuery(document).ready(function($) {
    // Mobile menu toggle
    $('.menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.nav-menu').toggleClass('toggled');
        
        // Update aria-expanded
        var expanded = $(this).attr('aria-expanded') === 'true' || false;
        $(this).attr('aria-expanded', !expanded);
    });
    
    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });
    
    $('.back-to-top').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
    
    // Smooth scroll for anchor links
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
                return false;
            }
        }
    });
});
</script>

</body>
</html>

<?php
/**
 * Footer menu fallback
 */
function unlocking_ny_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'unlocking-ny') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'unlocking-ny') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/privacy-policy')) . '">' . esc_html__('Privacy Policy', 'unlocking-ny') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'unlocking-ny') . '</a></li>';
    echo '</ul>';
}
?>