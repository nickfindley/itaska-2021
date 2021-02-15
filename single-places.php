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
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content/single-place' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;

        if ( get_field( 'events_venue_id' ) ) :
            $upcoming_events = new WP_Query( array(
                'post_type' => array(Tribe__Events__Main::POSTTYPE),
                'eventDisplay' => 'list',
                'posts_per_page' => -1,
                'meta_key'=>'_EventStartDate',
                'orderby'=>'_EventStartDate',
                'order'=>'ASC',
                'tribeHideRecurrence' => true,
                'venue' => get_field( 'events_venue_id' )
            ));

            if ( $upcoming_events->have_posts() ) : ?>
                <section class="single-place-upcoming-events">
                    <header class="single-place-events-header container">
                        <h2>Upcoming Events</h2>
                    </header>
                <?php
                while ( $upcoming_events->have_posts() ) :
                    $upcoming_events->the_post();
                    get_template_part( 'content/single-place-upcoming-event' );
                endwhile;
                wp_reset_postdata();
                ?>
                </section>
                <?php
            endif;

            $past_events = new WP_Query( array(
                'post_type' => array(Tribe__Events__Main::POSTTYPE),
                'eventDisplay' => 'past',
                'posts_per_page' => 10,
                'meta_key'=>'_EventStartDate',
                'orderby'=>'_EventStartDate',
                'order'=>'DESC',
                'tribeHideRecurrence' => true,
                'venue' => get_field( 'events_venue_id' )
            ));

            if ( $past_events->have_posts() ) :
                ?>
                <section class="single-place-past-events">
                    <header class="single-place-events-header container">
                        <h2>Past Events</h2>
                    </header>
                <?php
                while ( $past_events->have_posts() ) :
                    $past_events->the_post();
                    get_template_part( 'content/single-place-past-event' );
                endwhile;
                wp_reset_postdata();
                ?>
                </section>
                <?php
            endif;
        endif;
        ?>
        <div class="main-footer-container container">
            <footer class="main-footer">
                <p><?php dutchtown_footer_social_links( 'Share this place on' ); ?>
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