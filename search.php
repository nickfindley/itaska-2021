<?php
/**
 * The template file for displaying search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-search" id="content">
    <header class="main-header">
		<div class="main-header-container container">
			<h1>
                <span>
                    <?php
                        if ( $wp_query->found_posts !== 0 ) :
                            echo $wp_query->found_posts;
                        else :
                            echo 'No';
                        endif;
                    ?>
                    search results for
                </span>
                <?php the_search_query(); ?>
            </h1>
		</div>
    </header>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
            the_post();
            switch_to_blog( $post->blog_id );
            if ( get_post_type() == 'places' ) :
                get_template_part( 'content/search/search-result-place' );
            elseif ( get_post_type() == 'page' ) :
                get_template_part( 'content/search/search-result-page' );
            elseif ( function_exists( 'tribe_is_event' ) && tribe_is_event() ) :
                get_template_part( 'content/search/search-result-event' );
            else :
                get_template_part( 'content/search/search-result-post' );
            endif;
            restore_current_blog();
        endwhile;
        echo bootstrap_pagination();
    else : 
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>

	<div class="main-footer-container container">
        <footer class="main-footer">
        <?php if ( function_exists('yoast_breadcrumb') ) : ?>
            <p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p>
        <?php endif;?>
        </footer>
    </div>
</main>
<?php get_footer(); ?>