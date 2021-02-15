<?php
function dutchtown_archive_title( $title )
{
    if ( is_category() )
    {
        $title = '<span>Posts about </span>' . single_cat_title( '', false );
    }
    elseif ( is_tag() )
    {
        $title = '<span>Posts and events tagged </span>' . single_tag_title( '', false );
    }
    elseif ( is_author() )
    {
        $title = '<span>Posts by </span>' . get_the_author();
    }
    elseif ( is_year() )
    {
        $title = '<span>Posts from </span>' . get_the_date( 'Y' );
    }
    elseif ( is_month() )
    {
        $title = '<span>Posts from </span>' . get_the_date( 'F Y' );
    }
    elseif ( is_day() )
    {
        $title = '<span>Posts from </span>' . get_the_date( 'F jS, Y' );
    }
    elseif ( is_tax( 'place_category' ) )
    {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $title = '<span>Dutchtown Places<span class="sr-only">:</span> </span>' . $term->name;;
    }
    elseif ( is_post_type_archive( 'block_events' ) )
    {
        $title = 'Block Events';
    }
    return $title;
}

add_filter( 'get_the_archive_title', 'dutchtown_archive_title' );
?>