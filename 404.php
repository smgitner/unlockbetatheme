<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<!-- Main Content Area -->
<main class="main-content">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'unlocking-newyork'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'unlocking-newyork'); ?></p>

                <?php get_search_form(); ?>

                <div class="widget">
                    <h2 class="widget-title"><?php _e('Most Used Categories', 'unlocking-newyork'); ?></h2>
                    <ul>
                        <?php
                        wp_list_categories(array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => 1,
                            'title_li'   => '',
                            'number'     => 10,
                        ));
                        ?>
                    </ul>
                </div>

                <div class="widget">
                    <h2 class="widget-title"><?php _e('Archives', 'unlocking-newyork'); ?></h2>
                    <ul>
                        <?php
                        wp_get_archives(array(
                            'type'  => 'monthly',
                            'limit' => 12,
                        ));
                        ?>
                    </ul>
                </div>

                <div class="widget">
                    <h2 class="widget-title"><?php _e('Recent Posts', 'unlocking-newyork'); ?></h2>
                    <ul>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        foreach ($recent_posts as $post) :
                        ?>
                            <li>
                                <a href="<?php echo get_permalink($post['ID']); ?>">
                                    <?php echo $post['post_title']; ?>
                                </a>
                            </li>
                        <?php endforeach; wp_reset_query(); ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
