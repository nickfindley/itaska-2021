<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */


$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' — ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$event_id = Tribe__Main::post_id_helper();

/**
 * Returns a formatted time for a single event
 *
 * @var string Formatted time string
 * @var int Event post id
 */
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );

/**
 * Returns the title of the "Time" section of event details
 *
 * @var string Time title
 * @var int Event post id
 */
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time', 'the-events-calendar' ), $event_id );

$cost = tribe_get_formatted_cost();
$website = tribe_get_event_meta( get_the_ID(), '_EventURL', true );
$website_parse = parse_url( $website );
$website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST));
?>

<h3><?php esc_html_e( 'Event Details', 'the-events-calendar' ); ?></h3>
<dl>
<?php if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :?>

	<dt><i class="fas fa-fw fa-hourglass-start"></i> <?php esc_html_e( 'Start:', 'the-events-calendar' ); ?></dt>
	<dd><?php esc_html_e( $start_date ); ?></dd>
	<dt><i class="fas fa-fw fa-hourglass-end"></i> <?php esc_html_e( 'End:', 'the-events-calendar' ); ?></dt>
	<dd><?php esc_html_e( $end_date ); ?></dd>

<?php elseif ( tribe_event_is_all_day() ): ?>

	<dt><i class="fas fa-fw fa-calendar"></i> <?php esc_html_e( 'Date', 'the-events-calendar' ); ?></dt>
	<dd><?php esc_html_e( $start_date ); ?> </dd>

<?php elseif ( tribe_event_is_multiday() ) : ?>

	<dt><i class="fas fa-fw fa-hourglass-start"></i> <?php esc_html_e( 'Start Date', 'the-events-calendar' ); ?></dt>
	<dd><?php esc_html_e( $start_datetime ); ?></dd>
	<dt><i class="fas fa-fw fa-hourglass-end"></i> <?php esc_html_e( 'End Date', 'the-events-calendar' ); ?> </dt>
	<dd><?php esc_html_e( $end_datetime ); ?></dd>

<?php else : ?>

	<dt><i class="fas fa-fw fa-calendar"></i> <?php esc_html_e( 'Date', 'the-events-calendar' ); ?> </dt>
	<dd><?php esc_html_e( $start_date ); ?></dd>
	<dt><i class="fas fa-fw fa-clock"></i> <?php echo esc_html( $time_title ); ?> </dt>
	<dd><?php echo $time_formatted; ?></dd>

<?php endif ?>

<?php if ( ! empty( $cost ) ) : ?>

	<dt><i class="fas fa-fw fa-money-bill-alt"></i> <?php esc_html_e( 'Cost', 'the-events-calendar' ); ?></dt>
	<dd><?php esc_html_e( $cost ); ?></dd>

<?php endif ?>
	
<?php if ( ! empty( $website ) ) : ?>

	<dt><i class="fas fa-fw fa-external-link-alt"></i> <?php esc_html_e( 'Event Website', 'the-events-calendar' ); ?></dt>
	<dd><a href="<?php echo $website; ?>"><?php echo $website_host ?></a></dd>

<?php endif ?>
</dl>