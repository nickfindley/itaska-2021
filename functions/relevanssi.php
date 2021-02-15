<?php
// Blocks past events from search results and indexing.
function rlv_no_past_events( $status, $post_id )
{
	$end_date = get_post_meta( $post_id, '_EventEndDate', true );
	if ( $end_date ) :
		if ( strtotime( $end_date ) < time() ) :
			if ( 'relevanssi_post_ok' === current_filter() ) :
				$status = false;
			else :
				$status = true;
			endif;
		endif;
	endif;
	return $status;
}

add_filter( 'relevanssi_do_not_index', 'rlv_no_past_events', 10, 2 );
add_filter( 'relevanssi_post_ok', 'rlv_no_past_events', 10, 2 );