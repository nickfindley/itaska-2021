<?php
function dutchtown_enqueue_scripts()
{
    if ( ! is_admin() ) :
        wp_deregister_script( 'jquery' );

        // if ( 
        //     has_gform() || 
        //     is_singular( 'places' ) || 
        //     is_page( 'contact' ) ||
        //     is_page( 'volunteer' ) ||
        //     is_page( 'list' ) ||
        //     is_page( 'blocks' ) ||
        //     is_page( 'donate' ) ||
        //     is_page( 'forms' ) || 
        //     is_page( 'pay' ) || 
        //     ( function_exists( 'tribe_is_event' ) && tribe_is_event() ) 
        // ) :
            wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', false, '3.5.1', false );
            wp_enqueue_script( 'jquery' );
        // endif;
	endif;

    if ( function_exists( 'tribe_is_event' ) && tribe_is_event() ) :
        wp_enqueue_style( 'calendar', get_template_directory_uri() . '/dist/css/calendar.min.css' );
    endif;

    if ( is_front_page() || is_page_template( 'page-masonry.php' ) || is_archive( 'places' ) || is_single( 'black-owned' ) ) :
        wp_register_script( 'masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js', false, '4.2.2', true );

        wp_register_script( 'dutchtown_masonry_scripts', get_template_directory_uri() . '/dist/js/masonry.min.js', false, '1.0', true );
        
        wp_enqueue_script( 'masonry' );
        wp_enqueue_script( 'dutchtown_masonry_scripts' );
    endif;


    wp_register_script( 'bootstrap_bundle', get_template_directory_uri() . '/dist/js/main.js', false, '4.1.3', true );
    wp_enqueue_script( 'bootstrap_bundle' );

    // wp_register_script( 'forminator', autoversion( '/wp-content/themes/itaska/dist/js/forminator.js' ) );
    // wp_enqueue_script( 'forminator' );
    // switch_to_blog( 1 );
    // wp_localize_script( 'forminator', 'ajax_object', array(
    //     'ajaxurl' => admin_url( 'admin-ajax.php' )
    // ));
    // restore_current_blog();

    // wp_deregister_script( 'underscore' );
    // wp_register_script( 'underscore', ABSPATH . '/wp-includes/js/underscore.min.js', false, '1.83', true );
    // wp_enqueue_script( 'underscore' );

    // wp_register_script( 'fontawesome', 'https://kit.fontawesome.com/1d1921b870.js', false, '5.10.1', true );
    // wp_enqueue_script( 'fontawesome' );

    // wp_register_script( 'dutchtown_scripts', get_template_directory_uri() . '/dist/js/scripts.min.js', false, '1.0', true );
    // wp_enqueue_script( 'dutchtown_scripts' );

    wp_enqueue_style( 'main', autoversion( '/wp-content/themes/itaska/dist/css/main.min.css' ) );

    // wp_deregister_style( 'acf' );
    // wp_deregister_style( 'acf-field-group' );
    // wp_deregister_style( 'acf-global' );
    // wp_deregister_style( 'acf-input' );
    // wp_deregister_style( 'acf-pro-input' );
    // wp_deregister_style( 'acf-datepicker' );
}
add_action( 'wp_enqueue_scripts', 'dutchtown_enqueue_scripts' );

function dutchtown_enqueue_non_init_scripts()
{
    if ( is_singular() && comments_open() && get_option('thread_comments') )
    {
        wp_register_script( 'comment-reply', ABSPATH . '/wp-includes/js/comment-reply.min.js', false, '1.0', true );
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'dutchtown_enqueue_non_init_scripts' );

function dutchtown_remove_styles()
{
    wp_deregister_style( 'fancybox' );
    wp_deregister_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'dutchtown_remove_styles', 20 );
?>