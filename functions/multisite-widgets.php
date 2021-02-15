<?php
function url_get_contents ( $url )
{	
    if ( ! function_exists( 'curl_init' ) ) :
        die( 'The cURL library is not installed.' );
    endif;	
    $ch = curl_init();	
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
    curl_setopt( $ch, CURLOPT_FRESH_CONNECT,  true );
    $output = curl_exec( $ch );	
    curl_close( $ch );	
    return $output;	
}

// This is the function you use to place / call your sidebar at a specific theme location.
// Accepts the sidebar's id as a parameter.
function dutchtown_multisite_sidebar( $sidebar )
{
    // Try to get the stored widget content for the sidebar.
    $markup = get_site_transient( 'sidebar_cache_' . $sidebar );

    // If we're not on the main site and the transient exists, display the stored widget content.
    if ( ! is_main_site() && $markup ) :
        echo $markup;
    else :
        // If we're not on the main site and the transient doesn't exist, we make a call to the main site, which kicks off dutchtown_multisite_sidebar_save().
        if ( ! is_main_site() ) :
            $url = add_query_arg( array( 'get_sidebar' => $sidebar ), get_site_url( 1 ) );
            $request = url_get_contents( $url );

            // display the content
            echo get_site_transient( 'sidebar_cache_' . $sidebar );
        else :
            // If we're on the main site and the transient doesn't exist, store the widget content in the transient.
            ob_start();
            dynamic_sidebar( $sidebar );
            $markup = ob_get_clean();
            set_site_transient( 'sidebar_cache_' . $sidebar, $markup, 4*60*60 );
            echo $markup;
        endif;
    endif;
}

// add_action( 'template_redirect', 'dutchtown_multisite_sidebar_save' );
// function dutchtown_multisite_sidebar_save()
// {
//     // If we're on the main site and the get_sidebar query var is set,
//     // start a buffer that will record the widget content.
//     if ( is_main_site() && isset( $_GET['get_sidebar'] ) ) :
//         $sidebar = $_GET['get_sidebar'];
//         ob_start();
//         dynamic_sidebar( $sidebar );
//         $markup = ob_get_clean();

//         // Set a transient to store the HTML of the widget content
//         set_site_transient( 'sidebar_cache_' . $sidebar, $markup, 4*60*60 );

//         // Also display the content. This ensures that the content gets displayed if a site other than the main site is the first to be loaded after an update.
//         echo $markup;

//         die();
//     endif;
// }

// Delete all sidebar transients when editing sidebar widgets.
add_action( 'sidebar_admin_setup', 'dutchtown_multisite_sidebar_clear_cache' );
function dutchtown_multisite_sidebar_clear_cache() 
{
    global $wp_registered_sidebars;
    foreach( $wp_registered_sidebars as $sidebar) :
        delete_site_transient('sidebar_cache_' . $sidebar['id']);
        $url = add_query_arg( array( 'get_sidebar' => $sidebar['id'] ), get_site_url( 1 ) );
        $request = url_get_contents( $url );
        ob_start();
        dynamic_sidebar( $sidebar['id'] );
        $markup = ob_get_clean();
        set_site_transient( 'sidebar_cache_' . $sidebar['id'], $markup, 4*60*60 );
    endforeach;
}
?>