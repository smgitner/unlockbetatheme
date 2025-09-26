<?php
/**
 * The main template file
 *
 * @package Unlocking_NY
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php 
                                        the_post_thumbnail('unlocking-featured', array(
                                            'alt' => the_title_attribute(array('echo' => false))
                                        )); 
                                        ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="entry-header">
                                    <?php
                                    if (is_singular()) :
                                        the_title('<h1 class="entry-title">', '</h1>');
                                    else :
                                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                    endif;
                                    
                                    if ('post' === get_post_type()) :
                                    ?>
                                        <div class="entry-meta">
                                            <?php
                                            unlocking_posted_on();
                                            unlocking_posted_by();
                                            ?>
                                        </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </header><!-- .entry-header -->

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div><!-- .entry-summary -->

                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        <?php esc_html_e('Read More', 'unlocking-ny'); ?>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    
                                    <?php
                                    // Display categories and tags for posts
                                    if ('post' === get_post_type()) {
                                        $categories_list = get_the_category_list(esc_html__(', ', 'unlocking-ny'));
                                        if ($categories_list) {
                                            echo '<div class="cat-links">' . $categories_list . '</div>';
                                        }
                                    }
                                    ?>
                                </footer><!-- .entry-footer -->
                            </div><!-- .post-content -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                    <?php endwhile; ?>
                </div><!-- .posts-grid -->

                <?php
                // Posts navigation
                unlocking_ny_posts_navigation();
                ?>

            <?php else : ?>
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Nothing here', 'unlocking-ny'); ?></h1>
                    </header><!-- .page-header -->
                    
                    <div class="page-content">
                        <?php if (is_home() && current_user_can('publish_posts')) : ?>
                            <p>
                                <?php
                                printf(
                                    wp_kses(
                                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'unlocking-ny'),
                                        array(
                                            'a' => array(
                                                'href' => array(),
                                            ),
                                        )
                                    ),
                                    esc_url(admin_url('post-new.php'))
                                );
                                ?>
                            </p>
                        <?php elseif (is_search()) : ?>
                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'unlocking-ny'); ?></p>
                        <?php else : ?>
                            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'unlocking-ny'); ?></p>
                        <?php endif; ?>
                        
                        <?php get_search_form(); ?>
                    </div><!-- .page-content -->
                </section><!-- .no-results -->
            <?php endif; ?>
        </div><!-- .content-area -->
        
        <?php 
        // Show sidebar if enabled in customizer
        if (get_theme_mod('show_sidebar', true)) {
            get_sidebar();
        }
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php get_footer(); ?>