<?php
add_filter('gform_init_scripts_footer', '__return_true');

function dutchtown_gform_scripts()
{
    $version = 1.0;

    if ( ! is_admin() )
    {
        wp_deregister_script( 'gform_gravityforms' );
        wp_register_script( 'gform_gravityforms', plugins_url() . "/gravityforms/js/gravityforms.min.js", array( 'jquery' ), $version, true );

        wp_deregister_script( 'gform_placeholder' );
        wp_register_script( 'gform_placeholder', plugins_url() . "/gravityforms/js/placeholders.jquery.min.js", array( 'jquery' ), $version, true );

        wp_deregister_script( 'gform_masked_input' );
        wp_register_script( 'gform_masked_input', plugins_url() . "/gravityforms/js/jquery.maskedinput.min.js", array( 'jquery', 'gform_gravityforms' ), $version, true );

        wp_deregister_script( 'gform_conditional_logic' );
        wp_register_script( 'gform_conditional_logic', plugins_url() . "/gravityforms/js/conditional_logic.min.js", array( 'jquery', 'gform_gravityforms' ), $version, true );

        wp_deregister_script( 'gforms_stripe_frontend' );
        wp_register_script( 'gforms_stripe_frontend', plugins_url() . "/gravityformsstripe/js/frontend.min.js", array( 'jquery', 'gform_json', 'gform_gravityforms' ), $version, true );

        wp_deregister_script( 'gaddon_frontend' );
        wp_register_script( 'gaddon_frontend', plugins_url() . "/gravityforms/includes/addon/js/gaddon_frontend.min.js", null, $version, true );

        wp_deregister_script( 'stripe.js' );
        wp_register_script( 'stripe.js', 'https://js.stripe.com/v2/', null, $version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'dutchtown_gform_scripts' );


function wrap_gform_cdata_open( $content = '' )
{
    if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) 
    {
        return $content;
    }
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
    return $content;
}

function wrap_gform_cdata_close( $content = '' )
{
    if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) )
    {
        return $content;
    }
    $content = ' }, false );';
    return $content;
}

add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open', 1 );
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close', 99 );


// // Disable auto-complete on form.
// add_filter( 'gform_form_tag', function( $form_tag ) {
// 	return str_replace( '>', ' autocomplete="off">', $form_tag );
// }, 11 );

// // Diable auto-complete on each field.
// add_filter( 'gform_field_content', function( $input ) {
// 	return preg_replace( '/<(input|textarea)/', '<${1} autocomplete="off" ', $input );
// }, 11 ); 

function has_gform()
{
    global $post;
    $all_content = $post->post_content;
    if ( ( strpos( $all_content,'[gravityform' ) !== false ) OR ( strpos( $all_content,'wp:gravityforms' ) !== false ) ) :
        return true;
    else :
        return false;
    endif;
}
?>