<?php
/**
 * Month View Nav Template
 * This file loads the month view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.2
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>
<nav aria-label="Months">
	<ul class="pagination">
		<li class="page-item" aria-label="previous month link">
			<?php tribe_events_the_previous_month_link(); ?>
		</li>
		<li class="page-item" aria-label="next month link">
			<?php tribe_events_the_next_month_link(); ?>
		</li>
	</ul>
</nav>