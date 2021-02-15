<?php
/**
 * Day View Content
 * The content template for the day view. This template is also used for
 * the response that is returned on day view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/content.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>
<main class="main-events">
	<header class="main-header">
		<div class="main-header-container container">
			<h2><?php tribe_events_title() ?></h2>
		</div>
	</header>
	<?php tribe_the_notices() ?>
	<?php tribe_get_template_part( 'day/loop' ); ?>
	<footer>
		<?php tribe_get_template_part( 'day/nav' ); ?>
	</footer>
</main>