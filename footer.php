<!-- Footer -->
<footer class="footer">
    <div class="footer-image">
        <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/ship-icon.png" alt="Ship Icon" style="width: 100%; height: auto;">
    </div>
    
    <div class="footer-logos">
        <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/unlocking.png" alt="Unlocking" class="footer-logo">
        <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/newyork.png" alt="New York" class="footer-logo">
    </div>
    
    <div class="footer-links">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'menu_class'     => 'footer-nav',
            'container'      => false,
            'fallback_cb'    => 'unlocking_newyork_footer_fallback_menu',
        ));
        ?>
        
        <div class="social-links">
            <?php
            $social_links = unlocking_newyork_get_social_links();
            
            if (!empty($social_links['facebook'])) : ?>
                <a href="<?php echo esc_url($social_links['facebook']); ?>" class="social-link" title="Facebook">
                    <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/Icon/Facebook.png" alt="Facebook" style="width: 24px; height: 24px;">
                </a>
            <?php endif;
            
            if (!empty($social_links['instagram'])) : ?>
                <a href="<?php echo esc_url($social_links['instagram']); ?>" class="social-link" title="Instagram">
                    <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/Icon/Instagram.png" alt="Instagram" style="width: 24px; height: 24px;">
                </a>
            <?php endif;
            
            if (!empty($social_links['twitter'])) : ?>
                <a href="<?php echo esc_url($social_links['twitter']); ?>" class="social-link" title="Twitter/X">
                    <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/Icon/X.png" alt="X" style="width: 24px; height: 24px;">
                </a>
            <?php endif;
            
            if (!empty($social_links['linkedin'])) : ?>
                <a href="<?php echo esc_url($social_links['linkedin']); ?>" class="social-link" title="LinkedIn">
                    <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/Icon/LinkedIn.png" alt="LinkedIn" style="width: 24px; height: 24px;">
                </a>
            <?php endif;
            
            if (!empty($social_links['youtube'])) : ?>
                <a href="<?php echo esc_url($social_links['youtube']); ?>" class="social-link" title="YouTube">
                    <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/Icon/Youtube.png" alt="YouTube" style="width: 24px; height: 24px;">
                </a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="footer-divider"></div>
    
    <div class="footer-credits">
        <div class="credits-logos">
            <div class="credits-logo">
                <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/waer-logo.png" alt="SU" style="width: 100%; height: auto;">
            </div>
            <div class="credits-logo">
                <img src="https://raw.githubusercontent.com/smgitner/gitnerfiles/master/assets/images/nhlogo_white.png" alt="NH" style="width: 100%; height: auto;">
            </div>
        </div>
        
        <div class="credits-text">
            <p>© <?php echo date('Y'); ?> Copyright Syracuse University.</p>
            <br>
            <p>
                The S.I. Newhouse School of Public Communications<br>
                215 University Place, Syracuse, NY 13244
            </p>
        </div>
    </div>
</footer>

<script>
// Mobile Navigation Toggle
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('nav-links');
const closeMenu = document.getElementById('close-menu');

if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
}

if (closeMenu && navLinks) {
    closeMenu.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
    });
}

// Close mobile menu when clicking on a link
const navLinkItems = document.querySelectorAll('.nav-link');
navLinkItems.forEach(link => {
    link.addEventListener('click', () => {
        if (hamburger && navLinks) {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        }
    });
});

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (hamburger && navLinks && !hamburger.contains(e.target) && !navLinks.contains(e.target)) {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && hamburger && navLinks) {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
    }
});
</script>

<?php wp_footer(); ?>

</body>
</html>