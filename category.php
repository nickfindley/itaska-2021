<?php
/**
 * The template file for displaying archives
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
            <?php if ( category_description() ) :?>
            <section class="main-header-content">
                <?php echo category_description(); ?>
            </section>
            <?php endif; ?>
        </div>
    </header>

    <div class="archive-container container">
        <div class="row">
            <section class="archive-posts">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'content/archive' );
                    endwhile;
                    echo bootstrap_pagination();
                else : 
                    get_template_part( 'template-parts/content', 'none' );
                endif;		
                ?>
            </section>

            <aside class="archive-sidebar">
                <header>
                    <h2>All Categories</h2>
                </header>
                <ul class="list-unstyled archive-list"><?php 
                    $args = array(
                        'exclude' => '1',
                        'title_li' => '',
                        'show_count' => true
                    );
                    wp_list_categories( $args);
                ?></ul>

                <header class="search-header">
                    <h2>Search DutchtownSTL</h2>
                </header>
                <?php get_search_form(); ?>
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