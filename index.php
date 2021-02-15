<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header();
?>
<main class="main-index" id="content">
<?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'content/post' );
        endwhile;
        bootstrap_pagination();
    else : 
        get_template_part( 'template-parts/content', 'none' );
    endif;
?>
</main>
<?php get_footer(); ?>