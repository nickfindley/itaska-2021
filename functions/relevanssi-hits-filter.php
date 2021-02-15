<?php
function rlv_cull_recurring_events( $hits )
{ 
    $ok_results = array(); 
    $posts_seen = array(); 
    $index_by_title = array(); 
    $date_by_title = array(); 
    $i = 0; 
    foreach ( $hits[0] as $hit ) : 
        if ( ! isset ( $posts_seen[$hit->post_title] ) ) : 
            $ok_results[] = $hit; 
            $date_by_title[$hit->post_title] = get_post_meta( $hit->ID, '_EventStartDate', true ); 
            $index_by_title[$hit->post_title] = $i; 
            $posts_seen[$hit->post_title] = true; 
            $i++; 
        else :
            if ( get_post_meta( $hit->ID, '_EventStartDate', true ) < $date_by_title[$hit->post_title] ) :
                if ( strtotime( get_post_meta( $hit->ID, '_EventStartDate', true ) ) < time() ) :
                    continue; // Skips events that are in the past.
                endif;
                $date_by_title[$hit->post_title] = get_post_meta( $hit->ID, '_EventStartDate', true ); 
                $ok_results[$index_by_title[$hit->post_title]] = $hit;
            endif;
        endif;
    endforeach;
    $hits[0] = $ok_results;
    return $hits;
}

add_filter( 'relevanssi_hits_filter', 'rlv_cull_recurring_events' ); 



// add_filter( 'relevanssi_hits_filter', 'rlv_remove_broadcasts' );

// function rlv_remove_broadcasts( $hits ) {
//     $valid_posts = array();
//     foreach ( $hits[0] as $hit ) {
//         $switched_blog = false;
//         if ( $hit->blog_id ) {
//             switch_to_blog( $hit->blog_id );
//             $switched_blog = true;
//         }
//         $broadcast_data = ThreeWP_Broadcast()->get_post_broadcast_data( get_current_blog_id(), $hit->ID );
//         if ( ! $broadcast_data->get_linked_parent() ) {
//             $valid_posts[] = $hit;
//         }
//         if ( $switched_blog ) {
//             restore_current_blog();
//         }
//     }
//     $hits[0] = $valid_posts;
//     return $hits;
// }