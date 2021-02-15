<?php
/**
 * Template Name: Black Owned Places
 * Archive of all places listed as Black Owned.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-single-place" id="content">
    <?php if ( has_post_thumbnail() ) : ?>
    <header class="main-header main-has-featured-image">
        <div class="main-header-image-container container">
            <div class="main-header-image">
                <?php the_post_thumbnail( 'xl', ['class' => 'no-lazyload'] ); ?>
            </div>
        </div>
        <div class="main-header-container container">
            <h1><a href="<?php the_permalink(); ?>">
                <?php
                    if ( get_field( 'places_page_pre_title', 'option' ) ) :
                ?>
                    <span class="pre-header-title"><?php the_field( 'places_page_pre_title', 'option' ); ?></span>
                <?php
                    endif;
                    the_title();
                    if ( get_field( 'places_page_post_title', 'option' ) ) :
                ?>
                    <span class="post-header-title"><?php the_field( 'places_page_post_title', 'option' ); ?></span>
                <?php
                    endif;
                ?>
            </a></h1>
    <?php else : ?>
    <header class="main-header">
        <div class="main-header-container container">
            <h1><a href="<?php the_permalink(); ?>">
                <?php
                    if ( get_field( 'places_page_pre_title', 'option' ) ) :
                ?>
                    <span class="pre-header-title"><?php the_field( 'places_page_pre_title', 'option' ); ?></span>
                <?php
                    endif;
                    the_title();
                    if ( get_field( 'places_page_post_title', 'option' ) ) :
                ?>
                    <span class="post-header-title"><?php the_field( 'places_page_post_title', 'option' ); ?></span>
                <?php
                    endif;
                ?>
            </a></h1>
    <?php endif; ?>
            <section class="main-meta">
                <ul>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        </div>
    </header>
    <div class="places-container container places-new">
        
        <?php
            // if ( get_field( 'places_page_content', 'option' ) ) :
        ?>
        <section class="places-content">
            <!-- <?php the_field( 'places_page_content', 'option' ); ?> -->
            <?php the_content(); ?>
        </section>
        <?php  
            // endif;
        ?>

        <section class="places-list" id="places-list">
            <?php
                $custom_terms = get_terms('place_category');
            ?>
            <h2>Jump to Category</h2>
            <ul class="places-categories">
            <?php
                //  https://wordpress.stackexchange.com/questions/66219/list-all-posts-in-custom-post-type-by-taxonomy
                $custom_terms = get_terms('place_category');
                foreach( $custom_terms as $custom_term ) :
                    wp_reset_query();
                    $args = array(
                        'post_type' => 'places',
                        'tax_query' => array(
                            'relation' => 'and',
                            array(
                                'taxonomy' => 'place_category',
                                'field' => 'slug',
                                'terms' => $custom_term->slug,
                            ),
                        ),
                        'meta_query' => array(
                            'relation' => 'and',
                            array(
                                'key' => 'closed',
                                'value' => 0,
                                'compare' => '=='
                            ),
                            array(
                                'key' => 'black_owned',
                                'value' => 1,
                                'compare' => '=='
                            )
                        ),
                        'orderby' => 'post_title',
                        'order' => 'ASC',
                        'posts_per_page' => -1
                    );
                    $loop = new WP_Query($args);
                    if ( $loop->have_posts() ) :
            ?>
                <li>
                    <a href="#<?php echo $custom_term->slug; ?>"><?php echo $custom_term->name; ?></a>
                </li>
            <?php
                    endif;
                endforeach;
            ?>
            </ul>

            <section class="places-masonry masonry-container">
            <?php
                $term_count = 0;
                foreach( $custom_terms as $custom_term ) :
                    $term_count++;
                    wp_reset_query();
                    $args = array(
                        'post_type' => 'places',
                        'tax_query' => array(
                            'relation' => 'and',
                            array(
                                'taxonomy' => 'place_category',
                                'field' => 'slug',
                                'terms' => $custom_term->slug,
                            ),
                        ),
                        'meta_query' => array(
                            'relation' => 'and',
                            array(
                                'key' => 'closed',
                                'value' => 0,
                                'compare' => '=='
                            ),
                            array(
                                'key' => 'black_owned',
                                'value' => 1,
                                'compare' => '=='
                            )
                        ),
                        'orderby' => 'post_title',
                        'order' => 'ASC',
                        'posts_per_page' => -1
                    );

                    add_filter('posts_fields', 'wpcf_create_temp_column'); // Add the temporary column filter
                    add_filter('posts_orderby', 'wpcf_sort_by_temp_column'); // Add the custom order filter

                    $loop = new WP_Query($args);

                    remove_filter('posts_fields','wpcf_create_temp_column'); // Remove the temporary column filter
                    remove_filter('posts_orderby', 'wpcf_sort_by_temp_column'); // Remove the temporary order filter
                    
                    if ( $loop->have_posts() ) :
                    ?>

                    <div class="masonry-block" id="<?php echo $custom_term->slug; ?>">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="place-category">
                                    <a href="/places/category/<?php echo $custom_term->slug; ?>/">
                                        <?php echo $custom_term->name; ?>
                                    </a>
                                    <a href="#places-list"><span class="sr-only">Top</span><i class="fas fa-caret-up"></i></a>
                                </h2>
                                <ul>
                    <?php
                        while( $loop->have_posts() ) :
                            $loop->the_post();
                            if ( get_field( 'closed' ) == false && get_field( 'hide_from_listings' ) == false  ) :
                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                    <?php
                                $date = strtotime( get_field( 'new_in_town' ) );
                                $today = strtotime( date( 'Y-m-d' ) );
                                if ( $date != null && $date > $today ) : 
                    ?>
                                        <span class="new-in-town">New!</span>
                    <?php 
                                endif;
                    ?>
                                    </li>
                    <?php
                            endif;
                        endwhile;
                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    endif;
                endforeach
                    ?>
            </section>
        </section>
    </div>
    <div class="main-footer-container container">
        <footer class="main-footer">
        <?php
            if ( function_exists('yoast_breadcrumb') ) :
        ?>
            <p class="post-breadcrumbs">
                <?php yoast_breadcrumb(); ?>
            </p>
        <?php
            endif;
        ?>
        </footer>
    </div>
</main>
<?php get_footer(); ?>