<?php
function dutchtown_place_query_sort( $query ) {
    if ( !is_admin() && $query->is_tax( 'place_category' ) && $query->is_main_query() )
    {
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
        $query->set( 'posts_per_page', 10 );
    }
}
add_action( 'pre_get_posts', 'dutchtown_place_query_sort' );

function dutchtown_format_phone( $phone_number )
{
    // make sure we have something
    if ( ! get_field( 'telephone' ) ) { return ''; }
    
    // strip out everything but numbers
    $phone_number = preg_replace( "/[^0-9]/", "", $phone_number );
    $length = strlen($phone_number);
    
    switch( $length )
    {
        case 7:
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone_number);
        break;
    
        case 10:
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone_number);
        break;

        case 11:
        return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$2-$3-$4", $phone_number);
        break;

        default:
        return $phone_number;
        break;
    }
}
?>