<?php
function dutchtown_search_results_per_page( $query )
{
    if ( $query->is_search ) :
        $query->set( 'posts_per_page', '10' );
    endif;
    return $query;
}

add_filter( 'pre_get_posts','dutchtown_search_results_per_page' );