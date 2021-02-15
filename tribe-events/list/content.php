<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
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
	<?php tribe_get_template_part( 'list/loop' ); ?>
    <footer>
		<?php tribe_get_template_part( 'list/nav' ); ?>
	</footer>
</main>