<?php
// https://wordpress.org/support/topic/remove-past-events-from-xml-sitemap/
// Toggle post types off and on in Search Appearance to regenerate site maps

if ( is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) && function_exists( 'tribe_is_event' ) ) :

	/* add nofollow metatag to header of past events */
	// add_filter( "wpseo_robots", function( $robots )
    // {
    //     if ( tribe_is_past_event() == true) :
    //         return "noindex,follow";
    //     endif;
    //     return $robots;
	// });

    /* exclude past events from the sitemap */ 
	function dutchtown_expired_events( $ids )
    {
		$args = array(
			'post_type'     => array( Tribe__Events__Main::POSTTYPE ),
			'nopaging'      => true,
			'fields'        => 'ids',
			'meta_query'    => array(
				array(
					'key'       => '_EventEndDate',
					'value' 	=> '2020-01-01 01:00:00',
					'compare'   => '<',
					'type'      => 'DATETIME',
				),
			),
		);
		$expired_events = get_posts( $args );
		$ids = array_merge( $ids, $expired_events );
		$ids = array_map( 'absint', $ids );
		$ids = array_unique( $ids );
		return $ids;
	}
	add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'dutchtown_expired_events' );
endif;