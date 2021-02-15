<?php
global $blog_id;
$current_blog_id = get_current_blog_id();

if ( $current_blog_id !== 1 ) :
    add_filter( 'body_class', function( $classes ) {
        return array_merge( $classes, array( 'body-subsite' ) );
    } );
endif;
?>