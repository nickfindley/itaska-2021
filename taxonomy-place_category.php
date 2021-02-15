<?php
/**
 * The template for displaying all places
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-place-category" id="content">
    <header class="main-header">
		<div class="main-header-container container">
			<h1><?php the_archive_title(); ?></h1>
		</div>
    </header>
    <div class="places-container container">
        <div class="places-category">
            <section class="places-items">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        if ( ! get_field( 'closed' ) ) :
                            get_template_part( 'content/single-place-category' );
                        endif;
                    endwhile;
                    echo bootstrap_pagination();
                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                ?>
            </section>
            <section class="places-categories-list">
                <header class="places-list-header">
                    <h2>More Places</h2>
                </header>
                <ul class="places-categories">
                <?php
                    //  https://wordpress.stackexchange.com/questions/66219/list-all-posts-in-custom-post-type-by-taxonomy
                    $custom_terms = get_terms( 'place_category' );

                    foreach( $custom_terms as $custom_term ) :
                        wp_reset_query();
                        $args = array(
                            'post_type' => 'places',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'place_category',
                                    'field' => 'slug',
                                    'terms' => $custom_term->slug,
                                ),
                            ),
                            'orderby' => 'post_title',
                            'order' => 'ASC',
                            'posts_per_page' => -1
                        );
                        $loop = new WP_Query($args);
                        if ( $loop->have_posts() ) :
                            echo '<li><a href="/places/category/'  . $custom_term->slug . '/">' . $custom_term->name . '</a></li>';
                            echo "\n";
                        endif;
                    endforeach;
                ?>
                </ul>
            </section>
        </div>
    </div>
    <div class="main-footer-container container">
        <footer class="main-footer">
            <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
        </footer>
    </div>
</main>
<?php get_footer(); ?>