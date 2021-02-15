<?php
/**
 * Day View Loop
 * This file sets up the structure for the day loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/loop.php
 *
 * @version 4.4
 * @package TribeEventsCalendar 
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $more, $post, $wp_query;
$more = false;
$current_timeslot = null;
?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php do_action( 'tribe_events_inside_before_loop' ); ?>

	<?php if ( $current_timeslot != $post->timeslot ) : $current_timeslot = $post->timeslot; ?>
	<div class="timeslot-container container">
		<div class="timeslot">
			<h3><span>Events at </span><?php echo $current_timeslot; ?></h3>
		</div>
	</div>
	<?php endif; ?>

	<?php
		$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

		/**
		 * Filters the event type used when selecting a template to render
		 *
		 * @param $event_type
		 */
		$event_type = apply_filters( 'tribe_events_day_view_event_type', $event_type );

		tribe_get_template_part( 'list/single', $event_type );
	?>

	<?php do_action( 'tribe_events_inside_after_loop' ); ?>

<?php endwhile; ?>