<?php
/**
 * The template for displaying all single posts
 *
 * @package Unlocking_NY
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area single-post">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-image">
                            <?php 
                            the_post_thumbnail('full', array(
                                'alt' => the_title_attribute(array('echo' => false))
                            )); 
                            ?>
                        </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <?php if ('post' === get_post_type()) : ?>
                            <div class="entry-meta">
                                <?php
                                unlocking_posted_on();
                                unlocking_posted_by();
                                ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content(sprintf(
                            wp_kses(
                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'unlocking-ny'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ));
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'unlocking-ny'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php unlocking_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
                // Post navigation
                unlocking_ny_post_navigation();
                
                // Author bio
                if (is_single() && get_the_author_meta('description')) : ?>
                    <div class="author-info">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('user_email'), 80); ?>
                        </div>
                        <div class="author-description">
                            <h3 class="author-title">
                                <?php printf(esc_html__('About %s', 'unlocking-ny'), get_the_author()); ?>
                            </h3>
                            <p class="author-bio">
                                <?php the_author_meta('description'); ?>
                                <a class="author-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
                                    <?php printf(esc_html__('View all posts by %s', 'unlocking-ny'), get_the_author()); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // Comments section
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            <?php endwhile; // End of the loop. ?>
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