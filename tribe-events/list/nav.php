<?php
/**
 * List View Nav Template
 * This file loads the list view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.3
 *
 */
global $wp_query;

$events_label_plural = tribe_get_event_label_plural();

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>
<nav class="container" aria-label="Events">
	<ul class="pagination">
		<?php if ( tribe_has_previous_event() ) : ?>
		<li class="page-item" aria-label="Previous day link">
			<a class="page-link" href="<?php echo esc_url( tribe_get_listview_prev_link() ); ?>" rel="prev"><i class="fas fa-caret-left"></i> <?php echo esc_html( sprintf( __( 'Previous %s', 'the-events-calendar' ), $events_label_plural ) ); ?></a>
		</li>
		<?php endif; ?>
		<?php if ( tribe_has_next_event() ) : ?>
		<li class="page-item" aria-label="Next day link">
			<a class="page-link" href="<?php echo esc_url( tribe_get_listview_next_link() ); ?>" rel="next"><?php echo esc_html( sprintf( __( 'Next %s', 'the-events-calendar' ), $events_label_plural ) ); ?> <i class="fas fa-caret-right"></i></a>
		</li>
		<?php endif; ?>
	</ul>
</nav>