<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * @version 4.6.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();
$venue_address = tribe_get_address();
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';
$organizer = tribe_get_organizer();
$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue         = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

require get_template_directory() . '/functions/venue-link.php';
?>

<article class="featured-event item-event">
    <div class="item-article-container container">
    <?php if ( has_post_thumbnail() ) : ?>
        <header class="item-header item-has-featured-image">
            <div class="item-header-image">
                <?php the_post_thumbnail(); ?>
            </div>
            <h2><span class="featured-event-tag">Featured Event </span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php else : ?>
        <header class="item-header">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>
			<section class="item-meta">
                <ul>
                    <?php
                    if ( tribe_is_recurring_event() ) :
                        echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-menta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . tribe_get_start_date() . '</a></li>';
                    else :
                        echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-menta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . tribe_get_start_date() . '</a></li>';
                    endif;
                    if ( tribe_is_recurring_event() ) : ?>
                    <li><i class="fas fa-fw fa-calendar-alt"></i><a href="<?php echo tribe_all_occurences_link(); ?>">See all instances</a></li>
                    <?php endif;
                    if ( tribe_get_cost() ) : ?><li><i class="fas fa-fw fa-money-bill-alt"></i><?php echo tribe_get_cost( null, true ) ?></li><?php endif;
                    if ( $venue_link ) : ?><li><i class="fas fa-fw fa-map-marker-alt"></i><?php echo $venue_link; ?></li><?php endif; ?>
                </ul>
                    <?php if ( $venue_link ) : ?><ul class="item-meta-location"><li><i class="fas fa-fw fa-map-marker-alt"></i><span class="post-meta-expanded">At </span><?php echo $venue_link; ?></li></ul><?php endif;
                    ?>
                <ul class="item-meta-share-links">
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
		</header>
		<section class="item-content">
            <?php echo get_excerpt_by_id( get_the_ID() ); ?>
        </section>
	</div>
</article>