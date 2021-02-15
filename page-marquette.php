<?php
/**
 * Template Name: Marquette Template
 * The template for a Marquette Park page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-marquette" id="content">
    <article>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'content/page-marquette' );
        endwhile;
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;	
    ?>
    </article>
</main>
<?php get_footer(); ?>