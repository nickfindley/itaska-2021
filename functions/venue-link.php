<?php
$venue_id = tribe_get_venue_id();
$venue_name = strip_tags( tribe_get_venue() );

if ( ! empty ( get_field( 'place_url', $venue_id ) ) ) :
    $venue_url = get_field( 'place_url', $venue_id );
    $venue_link = '<a href="' . $venue_url . '">' . $venue_name .'</a>';

elseif ( ! empty ( get_field( 'place_id', $venue_id ) ) ) : 
    $venue_url = get_permalink( get_field( 'place_id', $venue_id ) );
    $venue_link = '<a href="' . $venue_url . '">' . $venue_name .'</a>';

else :
    $venue_args = array(
        'post_type' => 'places',
        'posts_per_page' => 1,
        'title' => $venue_name
    );
    $venue_query = new WP_Query($venue_args);
    if ( $venue_query->have_posts() ) :
        if ( $venue_query->post_count == 1 ) :
            while ( $venue_query->have_posts() ) :
                $temp_post = $post;
                $venue_query->the_post();
                $venue_url = get_permalink( get_the_ID() );
                $venue_link = '<a href="' . $venue_url . '">' . $venue_name .'</a>';
                $post = $temp_post;
            endwhile;
        endif;        
    else :
        $venue_link = tribe_get_venue_link();
    endif;
endif;
?>