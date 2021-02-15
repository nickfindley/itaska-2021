<?php
/**
 * The template for the front page - either a static page, or posts if no static page is set
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
    <?php
    if ( get_current_blog_id() == 1 ) :
    ?>
    <main class="main-page" id="content">
        <article>
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content/front-page' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
    ?>
        </article>
    </main>	
    
    <?php
    elseif ( get_current_blog_id() == 4 ) :
    ?>
    <main class="main-page" id="content">
        <article>
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content/front-page-cid' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
    ?>
        </article>
    </main>	

    <?php
    elseif ( get_current_blog_id() == 6 ) :
    ?>
    <main class="main-page" id="content">
        <article>
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content/front-page-dt2' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
    ?>
        </article>
    </main>	
    
    <?php
    else :
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
    <?php
    endif;
    ?>
<?php get_footer(); ?>