/**
 * Mobile Menu JavaScript - Rebuilt
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const hamburgerToggle = document.getElementById('hamburger-toggle');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuContent = mobileMenuOverlay?.querySelector('.mobile-menu-content');
    
    // Function to open mobile menu
    function openMobileMenu() {
        if (hamburgerToggle) hamburgerToggle.classList.add('active');
        if (mobileMenuOverlay) mobileMenuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
    
    // Function to close mobile menu
    function closeMobileMenu() {
        if (hamburgerToggle) hamburgerToggle.classList.remove('active');
        if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }
    
    // Hamburger toggle click event
    if (hamburgerToggle) {
        hamburgerToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (mobileMenuOverlay.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }
    
    // Close button click event
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }
    
    // Overlay click event (click outside menu to close)
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function(e) {
            if (e.target === mobileMenuOverlay) {
                closeMobileMenu();
            }
        });
    }
    
    // Menu link click events
    const menuLinks = document.querySelectorAll('.mobile-nav-links a');
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            closeMobileMenu();
        });
    });
    
    // Window resize event
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeMobileMenu();
        }
    });
    
    // Escape key to close menu
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenuOverlay?.classList.contains('active')) {
            closeMobileMenu();
        }
    });
});
