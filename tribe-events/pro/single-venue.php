<?php
/**
 * Single Venue Template
 * The template for a venue. By default it displays venue information and lists
 * events that occur at the specified venue.
 *
 * This view contains the filters required to create an effective single venue view.
 *
 * @package TribeEventsCalendarPro
 *
 * @version 4.4.24
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! $wp_query = tribe_get_global_query_object() ) {
    return;
}

$venue_id     = get_the_ID();
$full_address = tribe_get_full_address();
$telephone    = tribe_get_phone();
$website_link = tribe_get_venue_website_link();
while ( have_posts() ) : the_post(); ?>
<main class="main-events">
	<article>
        <header class="main-header">
            <div class="main-header-container container">
                <h1 class="tribe-events-page-title"><span>Venue </span><?php the_title() ?></h1>
            </div>
        </header>

        <section class="main-content">
            <div class="main-content-container container">
                <?php tribe_the_notices() ?>
                <div class="venue-info">
                    <section class="venue-meta">
                        <dl>
                        <?php if ( tribe_get_address() ) : ?>
                        <dt><i class="fas fa-fw fa-map-marker-alt"></i> Address</dt>
                        <dd><address>
                            <?php echo tribe_get_address(); ?><br>
                            <?php echo tribe_get_city() . ', ' . tribe_get_region() . ' ' . tribe_get_zip(); ?>
                        </address></dd>
                        <?php endif; ?>

                        <?php if ( $telephone ): ?>
                        <dt><i class="fas fa-phone"></i> Telephone</dt>
                        <dd><?php echo $telephone; ?></dd>
                        <?php endif; ?>

                        <?php
                            if ( $website_link ):
                            $website = tribe_get_venue_website_url();
                            $website_parse = parse_url( $website );
                            $website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST));
                        ?>
                        <dt><i class="fas fa-external-link-alt"></i> Website</dt>
                        <dd><a href="<?php echo $website; ?>"><?php echo $website_host; ?></a></dd>
                        <?php endif; ?>
                        </dl>
                        <?php the_content(); ?>
                    </section>
                    <section class="venue-map">
                        <?php echo tribe_get_embedded_map( $venue_id, '100%', '200px' ); ?>
                    </section>
                </div>
            </div>
        </section>
    </article>

    <?php
    $upcoming_events = new WP_Query( array(
        'post_type' => array(TribeEvents::POSTTYPE),
        'eventDisplay' => 'upcoming',
        'posts_per_page' => -1,
        'meta_key' => '_EventStartDate',
        'orderby' => '_EventStartDate',
        'order' => 'ASC',
        'tribeHideRecurrence' => true,
        'venue' => $venue_id
    ));

    if ( $upcoming_events->have_posts() )
    {
        ?>
        <section class="upcoming-events container">
            <header class="upcoming-events-header">
                <h2>Upcoming Events</h2>
            </header>
        <?php
        while ( $upcoming_events->have_posts() )
        {
            $upcoming_events->the_post();
            get_template_part( 'content/single-place-event' );
        }
        wp_reset_postdata();
        ?>
        </section>
        <?php
    }
    else{
        ?>
        <section class="upcoming-events container">
           <div class="tribe-events-notices">
                <p>This venue doesn&apos;t have any events currently scheduled.</p>
            </div>
        </section>
        <?php
    }
    ?>
</main>	
<?php endwhile; ?>