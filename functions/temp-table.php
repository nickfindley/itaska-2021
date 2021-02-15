<?php

//  https://css-tricks.com/ignoring-the-in-wordpress-queries/

function wpcf_create_temp_column($fields)
{
    global $wpdb;
    $matches = 'The';
    $has_the = " CASE 
        WHEN $wpdb->posts.post_title regexp( '^($matches)[[:space:]]' )
            THEN trim(substr($wpdb->posts.post_title from 4)) 
        ELSE $wpdb->posts.post_title 
            END AS title2";
    
    if ($has_the)
    {
        $fields .= ( preg_match( '/^(\s+)?,/', $has_the ) ) ? $has_the : ", $has_the";
    }

    return $fields;
}

function wpcf_sort_by_temp_column ($orderby)
{
    $custom_orderby = " UPPER(title2) ASC";
    
    if ($custom_orderby)
    {
        $orderby = $custom_orderby;
    }

    return $orderby;
}
?>