<?php
/**
 * The template for a single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-single" id="content">
    <article>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'content/single' );
        endwhile;
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;	
    ?>
    </article>
</main>
<?php get_footer(); ?>