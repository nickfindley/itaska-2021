<?php
/**
 * Template Name: Poll Page
 * The template for a page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
acf_form_head();
get_header(); ?>
<main class="main-page" id="content">
    <article>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            if ( has_post_thumbnail() ) : ?>
    <header class="main-header main-has-featured-image">
        <div class="main-header-image-container container">
            <div class="main-header-image">
                <?php the_post_thumbnail( 'xl', ['class' => 'no-lazyload'] ); ?>
            </div>
        </div>
        <div class="main-header-container container">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php else : ?>
    <header class="main-header">
        <div class="main-header-container container">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php endif; ?>
        <?php if ( ! is_page( array( 'contact', 'list', 'volunteer' ) ) ) : ?>
            <section class="main-meta">
                <ul>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        <?php endif; ?>
        </div>
    </header>
    <section class="main-content">
        <div class="main-content-container container">
            <?php
                the_content(); 
            ?>
    </section>
    <div class="main-footer-container container">
        <footer class="main-footer">
            <?php if ( ! is_page( array( 'contact', 'list', 'volunteer' ) ) ) : ?><p><?php dutchtown_footer_social_links( 'Share this page on' ); ?><?php if ( dutchtown_is_updated() ) : ?> This page was last updated on <?php dutchtown_updated_on(); ?>.<?php endif; ?></p><?php endif; ?>
            <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
        </footer>
    </div>
    <?php
        endwhile;
    endif;		
    ?>
    </article>
</main>
<?php get_footer(); ?>