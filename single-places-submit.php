<?php
/**
 * The template for a single place
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header();
?>
<main class="main-single-place" id="content">
    <article>
        <?php if ( has_post_thumbnail() ) : ?>
        <header class="main-header main-has-featured-image">
            <div class="main-header-image-container container">
                <div class="main-header-image">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div>
            <div class="main-header-container container">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php else : ?>
        <header class="main-header">
            <div class="main-header-container container">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>
            </div>
        </header>
        <section class="main-content">
            <div class="main-content-container container">
                <?php echo do_shortcode( '[forminator_form id="397829"]' ); ?>
                <p class="small muted">Places are added to the directory at the discretion of DutchtownSTL and as time and resources permit. Inclusion is not guaranteed.</p> 
            </div>
        </section>
        <div class="main-footer-container container">
            <footer class="main-footer">
                <?php if ( dutchtown_is_updated() ) : ?>
                This page was last updated on <?php dutchtown_updated_on(); ?>.
                <?php endif; ?></p>
                <p class="place-disclaimer">All listings in the <a href="/places/">Dutchtown Places Directory</a> are accurate at the time of publication to the best of our knowledge. Always contact the establishment for the most current hours and other information. Please <a href="/contact/">contact us</a> with any updates.</p>
                <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
            </footer>
        </div>
    </article>
</main>
<?php get_footer(); ?>