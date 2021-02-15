<?php
/**
 * The template file for displaying tag archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-archive" id="content">
    <header class="main-header">
        <div class="main-header-container container">
            <?php
            $id = 'category_' . get_queried_object_id();
            $image = get_field( 'category_image', $id );
            $size = 'full';
            if ( $image ) :
            ?>
            <div class="main-header-image">
                <?php echo wp_get_attachment_image( $image, $size ); ?>
            </div>
            <?php endif; ?>
            <h1><?php the_archive_title(); ?></h1>
            <?php if ( tag_description() ) :?>
            <section class="main-header-content">
                <?php echo tag_description(); ?>
            </section>
            <?php endif; ?>
        </div>
    </header>

    <div class="archive-container container">
        <div class="row">
            <section class="archive-posts">
                <?php
                $paged  = get_query_var('paged') ? get_query_var('paged') : 1;
                $tag = get_queried_object();
                $args = array(
                    'paged' => $paged,
                    'posts_per_page' => 10,
                    'tag' => $tag->slug
                );

                $posts_query = new WP_Query( $args );
                
                if ( $posts_query->have_posts() ) :
                    while ( $posts_query->have_posts() ) :
                        $posts_query->the_post();
                        get_template_part( 'content/archive' );
                    endwhile;
                    echo bootstrap_pagination( $posts_query );
                    wp_reset_postdata();	
                endif;
                ?>
            </section>

            
            <aside class="archive-sidebar">
                <header class="search-header">
                    <h2>Search DutchtownSTL</h2>
                </header>
                <?php get_search_form(); ?>
                
                <header>
                    <h2>More Tags</h2>
                </header>
                <?php
                    $exclude = array(
                        'art-lab',
                        'class',
                        'hop-shop',
                        'intersect',
                        'tdlc',
                        'thomas-dunn',
                        'wood-shop',
                        'youth-activities'
                    );

                    $tag_ids = array();
                    foreach( $exclude as $e ) :
                        $tag = get_term_by('slug', $e,'post_tag');
                        $tag_ids[] =  $tag->term_id;
                    endforeach;

                    $args = array(
                        'exclude' => $tag_ids,
                        'separator' => ' · ',
                        'smallest' => .75,
                        'largest' => 1.5,
                        'unit' => 'rem'
                    );

                    echo '<p>' . wp_tag_cloud( $args ) . '</p>';
                ?>
            </aside>
        </div>
    </div>

    <div class="main-footer-container container">
        <footer class="main-footer">
        <?php if ( function_exists('yoast_breadcrumb') ) : ?>
            <p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p>
        <?php endif;?>
        </footer>
    </div>
</main>
<?php get_footer(); ?>