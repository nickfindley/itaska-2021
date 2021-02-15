<?php
function dutchtown_events_previous_month_link()
{
    $url = tribe_get_previous_month_link();
    $date = Tribe__Events__Main::instance()->previousMonth(tribe_get_month_view_date());
    $text = tribe_get_previous_month_text();
    $html = '<a class="page-link" data-month="' . $date . '" href="' . esc_url($url) . '" rel="prev"><i class="fas fa-caret-left"></i> ' . $text . ' </a>';
    return $html;
}

add_filter('tribe_events_the_previous_month_link', 'dutchtown_events_previous_month_link');

function dutchtown_events_next_month_link()
{
    $url = tribe_get_next_month_link();
    $date = Tribe__Events__Main::instance()->nextMonth(tribe_get_month_view_date());
    $text = tribe_get_next_month_text();
    $html = '<a class="page-link" data-month="' . $date . '" href="' . esc_url($url) . '" rel="next">' . $text . ' <i class="fas fa-caret-right"></i></a>';
    return $html;
}

add_filter('tribe_events_the_next_month_link', 'dutchtown_events_next_month_link');

function dutchtown_events_date_headers( $html ) {
	global $post, $wp_query;

	$event_year        = tribe_get_start_date( $post, false, 'Y' );
	$event_month       = tribe_get_start_date( $post, false, 'm' );
	$month_year_format = tribe_get_date_option( 'monthAndYearFormat', 'F Y' );

	if ( $wp_query->current_post > 0 )
	{
		$prev_post = $wp_query->posts[ $wp_query->current_post - 1 ];
		$prev_event_year = tribe_get_start_date( $prev_post, false, 'Y' );
		$prev_event_month = tribe_get_start_date( $prev_post, false, 'm' );
	}

	if ( $wp_query->current_post === 0 || ( $prev_event_month != $event_month || ( $prev_event_month == $event_month && $prev_event_year != $event_year ) ) )
	{
		$html = sprintf( '<div class="tribe-events-list-separator-month-container"><div class="tribe-events-list-separator-month"><h3>%s</h3></div></div>', tribe_get_start_date( $post, false, $month_year_format ) );
	}
	return $html;
}

add_filter('tribe_events_list_the_date_headers', 'dutchtown_events_date_headers');

function dutchtown_events_archive_titles ( $original_recipe_title, $depth ) {

	// Modify the titles here
	// Some of these include %1$s and %2$s, these will be replaced with relevant dates
	$title_upcoming =   'Upcoming Events'; // List View: Upcoming events
	$title_past =       'Past Events'; // List view: Past events
	$title_range =      '<span>Events for </span>%1$s&ndash;%2$s'; // List view: range of dates being viewed
	$title_month =      '<span>Events in </span>%1$s'; // Month View, %1$s = the name of the month
	$title_day =        '<span>Events on </span>%1$s'; // Day View, %1$s = the day
	$title_all =        '<span>All instances of </span>%s'; // showing all recurrences of an event, %s = event title
	$title_week =       '<span>Events for the week of </span>%s'; // Week view

	// Don't modify anything below this unless you know what it does
	global $wp_query;
	$tribe_ecp = Tribe__Events__Main::instance();
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );

	// Default Title
	$title = $title_upcoming;

	// If there's a date selected in the tribe bar, show the date range of the currently showing events
	if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {

		if ( $wp_query->get( 'paged' ) > 1 ) {
			// if we're on page 1, show the selected tribe-bar-date as the first date in the range
			$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
		} else {
			//otherwise show the start date of the first event in the results
			$first_event_date = tribe_event_format_date( $_REQUEST['tribe-bar-date'], false );
		}

		$last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
		$title = sprintf( $title_range, $first_event_date, $last_event_date );
	} elseif ( tribe_is_past() ) {
		$title = $title_past;
	}

	// Month view title
	if ( tribe_is_month() ) {
		$title = sprintf(
			$title_month,
			date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
		);
	}

	// Day view title
	if ( tribe_is_day() ) {
		$title = sprintf(
			$title_day,
			date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
		);
	}

	// All recurrences of an event
	if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
		$title = sprintf( $title_all, get_the_title() );
	}

	// Week view title
	if ( function_exists('tribe_is_week') && tribe_is_week() ) {
		$title = sprintf(
			$title_week,
			date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
		);
	}

	if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
		$cat = get_queried_object();
		$title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $cat->name . ' ' . $title . '</a>';
	}

	return $title;
}
add_filter( 'tribe_get_events_title', 'dutchtown_events_archive_titles', 11, 2 );

/**
 * The Events Calendar - Remove Customizer CSS output
 * 
 * From https://gist.github.com/cliffordp/d70d30c6278ffab2ad1db579dd421421
 *
 * Related to this alternative: https://gist.github.com/cliffordp/13c7a2e3f91158d5c9d0fca075b121fb
 **/
function cliff_remove_tec_customizer_style_output() {
	if ( class_exists( 'Tribe__Customizer' ) ) {
		remove_action( 'wp_print_footer_scripts', array( Tribe__Customizer::instance(), 'print_css_template' ), 15 );
	}
}
add_action( 'init', 'cliff_remove_tec_customizer_style_output' );

function customize_tribe_events_breakpoint()
{
    return 752;
}
add_filter( 'tribe_events_mobile_breakpoint', 'customize_tribe_events_breakpoint' );

function dutchtown_events_excerpt_length( $words )
{
	$words = 20;	
	return $words;
}

if (tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' ))
{
    add_filter( 'excerpt_length', 'dutchtown_events_excerpt_length', 999 );
}

function dutchtown_venue_posts_per_page()
{
	// $posts_per_page = 10;
	return $posts_per_page;
}

add_filter( 'tribe_events_single_venue_posts_per_page', 'dutchtown_venue_posts_per_page', 100);

function dutchtown_events_excerpt_more()
{
    $link = get_permalink( get_the_ID() );
    $title = get_the_title( get_the_ID() );
    $html = '&hellip; <a href="' . $link . '">Find out more about ' . $title . ' <i class="fas fa-caret-right"></i></a>';
    return $html;
}

if (tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' ))
{
    add_filter( 'excerpt_more', 'dutchtown_events_excerpt_more', 999 );
}

add_action( 'wp_enqueue_scripts', 'deregister_tribe_styles' );

function use_list_view_for_categories( $query ) {
	// Disregard anything except a main archive query
	if ( is_admin() || ! $query->is_main_query() || ! is_archive() ) return;

	// We only want to catch *event* category requests being issued
	// against something other than list view
	if ( ! $query->get( 'tribe_events_cat' ) ) return;
	if ( tribe_is_list_view() ) return;

	// Get the term object
	$term = get_term_by( 'slug', $query->get( 'tribe_events_cat' ), Tribe__Events__Main::TAXONOMY );

	// If it's invalid don't go any further
	if ( ! $term ) return;

	// Get the list-view taxonomy link and redirect to it
	header( 'Location: ' . tribe_get_listview_link( $term->term_id ) );
	exit();
}
 
// Use list view for category requests by hooking into pre_get_posts for event queries
add_action( 'tribe_events_pre_get_posts', 'use_list_view_for_categories' );


function deregister_tribe_styles() {
	
	wp_deregister_style( 'tribe-events-full-pro-calendar-style' );
	wp_deregister_style( 'tribe-events-full-calendar-style' );

	wp_deregister_style( 'tribe-events-pro-calendar-style' );
	wp_deregister_style( 'tribe-events-calendar-style' );

	wp_deregister_style( 'tribe-events-calendar-pro-style' );
	wp_deregister_style( 'tribe-events-calendar-pro-mobile-style' );
	wp_deregister_style( 'tribe-events-calendar-full-pro-mobile-style' );
}

add_action( 'wp_enqueue_scripts', 'deregister_tribe_scripts' );

function deregister_tribe_scripts() {
    wp_deregister_script( 'tribe-events-pro' );
    wp_deregister_script( 'tribe-events-php-date-formatter' );
    wp_deregister_script( 'tribe-events-bar' );
    wp_deregister_script( 'tribe-events-calendar-script' );
    wp_deregister_script( 'tribe-events-bootstrap-datepicker' );
    wp_deregister_script( 'tribe-events-jquery-resize' );
    wp_deregister_script( 'jquery-placeholder' );
}

add_filter( 'tribe_events_add_no_index_meta', '__return_false' );
?>