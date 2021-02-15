<?php
add_filter('the_content','dutchtown_fancybox_data');

function dutchtown_fancybox_data( $content )
{
    $home_url = home_url();
    $content = str_replace( '<a href="' . $home_url . '/wp-content/uploads/','<a data-fancybox href="' . $home_url . '/wp-content/uploads/', $content );
    return $content;
}
?>