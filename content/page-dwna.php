<?php
/**
 * Template part for displaying a single DWNA page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
<header class="main-header main-has-featured-image">
    <div class="main-header-image-container container">
        <div class="main-header-image">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>
    <div class="main-header-container container">
        <h1><?php the_title(); ?></h1>
<?php else : ?>
<header class="main-header">
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php endif; ?>
    </div>
</header>
<section class="main-content">
    <div class="main-content-container container">
        <?php the_content(); ?>
    </div>
</section>
<section class="dwna-events">
<?php
    $upcoming_events = new WP_Query( array(
        'post_type' => array(Tribe__Events__Main::POSTTYPE),
        'eventDisplay' => 'list',
        'posts_per_page' => -1,
        'meta_key'=>'_EventStartDate',
        'orderby'=>'_EventStartDate',
        'order'=>'ASC',
        'tribeHideRecurrence' => true,
        'tax_query' => array(
            array(
                'taxonomy' => Tribe__Events__Main::TAXONOMY,
                'field' => 'slug',
                'terms' => 'dutchtown-west-neighborhood-association'
            )
        )
    ));

    if ( $upcoming_events->have_posts() ) :
        ?>
        <section class="dwna-events">
            <header class="events-header-container container">
                <h2>Upcoming Events</h2>
            </header>
        <?php
        while ( $upcoming_events->have_posts() ) :
            $upcoming_events->the_post();
            get_template_part( 'content/item-event' );
        endwhile;
        wp_reset_postdata();
        ?>
        </section>
        <?php
    endif;
?>
</section>
<div class="main-footer-container container">
    <footer class="main-footer">
        <?php if ( ! is_page( array( 'contact', 'mailing-list', 'volunteer' ) ) ) : ?><p><?php dutchtown_footer_social_links( 'Share this page on' ); ?><?php if ( dutchtown_is_updated() ) : ?> This page was last updated on <?php dutchtown_updated_on(); ?>.<?php endif; ?></p><?php endif; ?>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
    </footer>
</div>