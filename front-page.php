<?php
/**
 * The front page template file
 *
 * This is the template that displays the front page when a static front page is set.
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
                    // Display the page content (supports Gutenberg blocks)
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
        endif;
        ?>
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
