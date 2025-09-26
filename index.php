<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

get_header(); ?>

<!-- Main Content Area -->
<main class="main-content">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php
                    // Display the post content (supports Gutenberg blocks)
                    the_content();
                    
                    // Display pagination for multi-page posts
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'unlocking-newyork'),
                        'after'  => '</div>',
                    ));
                    ?>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <div class="no-posts">
                <h2><?php _e('Nothing Found', 'unlocking-newyork'); ?></h2>
                <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'unlocking-newyork'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        endif;
        ?>
    </div>
</main>


<?php get_footer(); ?>