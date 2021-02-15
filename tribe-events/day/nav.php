<?php
/**
 * Day View Nav
 * This file contains the day view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.2
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} 



?>
<nav aria-label="Days" class="container">
	<ul class="pagination">
		<li class="page-item" aria-label="Previous day link">
			<a class="page-link" href="<?php
                global $wp_query; 
                $start = $wp_query->get( 'start_date' );
                $minus_one = date( 'Y-m-d', strtotime(  $start . ' -1 day' ) );
                echo tribe_get_day_link( $minus_one ); ?>" rel="prev"><i class="fas fa-caret-left"></i> <span class="date-page-large"><?php echo date( 'l, F jS', strtotime( tribe_get_the_day_link_date( 'previous day' )) ); ?></span><span class="date-page-medium" aria-hidden="true"><?php echo date( 'l n/j', strtotime( tribe_get_the_day_link_date( 'previous day' )) ); ?></span><span class="date-page-small" aria-hidden="true"><?php echo date( 'n/j/Y', strtotime( tribe_get_the_day_link_date( 'previous day' )) ); ?></span></a>
		</li>
		<li class="page-item active">
			<span class="page-link current"><span class="date-page-large"><?php echo date( 'l, F jS', strtotime( $wp_query->get( 'start_date' ) ) ); ?></span><span class="date-page-medium" aria-hidden="true"><?php global $wp_query; echo date( 'l n/j', strtotime( $wp_query->get( 'start_date' ) ) ); ?></span><span class="date-page-small" aria-hidden="true"><?php global $wp_query; echo date( 'n/j/Y', strtotime( $wp_query->get( 'start_date' ) ) ); ?></span></span>
		</li>
		<li class="page-item" aria-label="Next day link">
			<a class="page-link" href="<?php  
                $plus_one = date( 'Y-m-d', strtotime(  $start . ' +1 day' ) );
                echo tribe_get_day_link( $plus_one ); ?>" rel="next"><span class="date-page-large"><?php echo date( 'l, F jS', strtotime( tribe_get_the_day_link_date( 'next day' )) ); ?></span><span class="date-page-medium" aria-hidden="true"><?php echo date( 'l n/j', strtotime( tribe_get_the_day_link_date( 'next day' )) ); ?></span><span class="date-page-small" aria-hidden="true"><?php echo date( 'n/j/Y', strtotime( tribe_get_the_day_link_date( 'next day' )) ); ?></span> <i class="fas fa-caret-right"></i></a>
		</li>
	</ul>
</nav>