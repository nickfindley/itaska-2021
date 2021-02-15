<?php
/**
 * Template Name: DT2 Template
 * The template for a DT2 page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-dt2" id="content">
    <article>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'content/page-dt2' );
        endwhile;
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;		
    ?>
    </article>
</main>
<?php get_footer(); ?>