<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<main class="main-calendar">
	<header class="main-header">
		<div class="main-header-container container">
			<h1><?php tribe_events_title(); ?></h1>
		</div>
	</header>
	<?php tribe_the_notices(); ?>
	<?php tribe_get_template_part( 'month/loop', 'grid' ); ?>
	<footer class="events-footer container">
		<?php tribe_get_template_part( 'month/nav' ); ?>
	</footer>
    <?php if( tribe_is_month() && !is_tax() ) : ?>
    <section class="main-content">
        <div class="main-content-container container">
            <p class="alert-message"><b>Dear Neighbors:</b> Due to the current public health crisis, many events are being postponed, rescheduled, or canceled. Please visit the event website or check in with event organizers to see if the listed events are planned to go on as scheduled.<br><br>Once things return to normal, it will be more important than ever to get out and support our local businesses and organizations. Please stay safe and healthy. We hope to get back to business as usual as soon as possible.</p>
            <h2>The Dutchtown Calendar</h2>
            <p>Thank you for visiting the Dutchtown Events Calendar! We aim to keep you up to date on all the neighborhood meetings, programs, classes, kids' activities, and other happenings in <a href="/calendar/category/dutchtown/" title="Find events in Dutchtown.">Dutchtown</a>, <a href="/calendar/category/gravois-park/" title="Find events in Gravois Park.">Gravois Park</a>, <a href="/calendar/category/marine-villa/" title="Find events in Marine Villa.">Marine Villa</a>, <a href="/calendar/category/mount-pleasant/" title="Find events in Mount Pleasant.">Mount Pleasant</a>, and on <a href="/calendar/category/cherokee-street/" title="Find events on Cherokee Street.">Cherokee Street</a>.</p>
            <p>We&apos;re constantly adding new events, so make sure to <a href="javascript:void(0);" class="click-to-bookmark" title="Click this link to bookmark this page in your browser.">bookmark this page</a> and check back often.</p>
            <h3>Submit an Event</h3>
            <p>If you have an event in the neighborhood that you'd like us to share, please <a href="/contact/">contact us</a> with the details of the event. Make sure to include the date, time, location, organizer, and a link to additional information when available.</p>
            <p class="small">Events are added to the Dutchtown Calendar at the discretion of <a href="/">DutchtownSTL.org</a> and as time and resources permit.</p>
        </div>
    </section>
    <?php endif; ?>
</main>