<?php
/**
 * Month View Single Day
 * This file contains one day in the month grid
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/single-day.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$day = tribe_events_get_current_month_day();
$datetime = DateTime::createFromFormat('Y-m-d', $day['date'] );
$events_label = ( 1 === $day['total_events'] ) ? tribe_get_event_label_singular() : tribe_get_event_label_plural();
?>

<!-- Day Header -->
<div id="tribe-events-daynum-<?php echo $day['daynum-id'] ?>">

	<?php if ( $day['total_events'] > 0 && tribe_events_is_view_enabled( 'day' ) ) : ?>
		<a href="<?php echo esc_url( tribe_get_day_link( $day['date'] ) ); ?>"></span><span class="table-day"><?php echo $datetime->format( 'l' ); ?></span><span class="table-month"><?php echo $datetime->format( 'F' ); ?></span><span class="table-number"><?php echo $day['daynum'] ?></span></a>
	<?php else : ?>
		<span class="table-no-events-date"><?php echo $datetime->format( 'l' ); ?> </span><?php echo $day['daynum']; ?>
	<?php endif; ?>

</div>

<!-- Events List -->
<div class="tribe-events-list-day">
<?php if ( $day['events']->have_posts() ) : ?>
	<?php while ( $day['events']->have_posts() ) : $day['events']->the_post(); ?>
		<?php tribe_get_template_part( 'month/single', 'event' ) ?>
	<?php endwhile; ?>
<?php else : ?>
	<div class="type-tribe_events tribe-no-events"><p>No events currently scheduled.</p></div>
<?php endif; ?>
</div>

<!-- View More -->
<?php if ( $day['view_more'] ) : ?>
	<div class="tribe-events-viewmore">
		<?php

			$view_all_label = sprintf(
				_n(
					'View %1$s %2$s',
					'View All %1$s %2$s',
					$day['total_events'],
					'the-events-calendar'
				),
				$day['total_events'],
				$events_label
			);

		?>
		<a href="<?php echo esc_url( $day['view_more'] ); ?>"><?php echo $view_all_label ?> &raquo;</a>
	</div>
<?php
endif;
