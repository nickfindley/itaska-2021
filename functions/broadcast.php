<?php
if ( function_exists( 'ThreeWP_Broadcast' ) ) :
function broadcasted_from()
{
    // Check that Broadcast is enabled.
    if ( ! function_exists( 'ThreeWP_Broadcast' ) )
        return;
    // Load the broadcast data for this post.
    global $post;
    $broadcast_data = ThreeWP_Broadcast()->get_post_broadcast_data( get_current_blog_id(), $post->ID );
    // This post must be a child. Check for a parent.
    $parent = $broadcast_data->get_linked_parent();
    if ( ! $parent )
        return;

    // Fetch the permalink
    switch_to_blog( $parent[ 'blog_id' ] );
    $blog_name = get_bloginfo( 'name' );
    $blog_link = get_site_url();
    restore_current_blog();

    // And now assemble a text.
    $r = sprintf( '<p class="broadcast">This post originally appeared on <a href="%s">%s</a>.</p>', $blog_link, $blog_name );
    return $r;
}
add_shortcode( 'broadcasted_from', 'broadcasted_from' );
endif;
?>