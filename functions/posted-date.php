<?php
if ( ! function_exists( 'dutchtown_posted_on' ) ) :
	/**
	 * Prints original post date wrapped in a permalink.
	 */
	function dutchtown_posted_on( $args = array() )
	{
        global $post;

		$defaults = array(
			'before_posted_on'	=> '',
			'after_posted_on'	=> ''
		);

		$args = wp_parse_args( $args, $defaults );

		$time_string = '<time datetime="%1$s">%2$s</time>';
		
		if ( function_exists( 'tribe_is_event' ) && tribe_is_event() )
		{
			$time_string = sprintf( $time_string,
				esc_attr( tribe_get_start_date( $post->ID, false, 'c' ) ),
				esc_html( tribe_get_start_date() )
			);
			$span_text = 'Event on ';
		}
		else
		{
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
			$span_text = 'Posted on ';
		}

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'dutchtown' ),
			'<span class="post-meta-expanded">' . $span_text . '</span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo  $args['before_posted_on'] . $posted_on . $args['after_posted_on'];
	}
endif;

if ( ! function_exists( 'dutchtown_is_updated' ) ) : 

	function dutchtown_is_updated()
	{
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
endif;

if ( ! function_exists( 'dutchtown_updated_on' ) ) : 
	/**
	 * Prints date of most recent update to post.
	 */
	function dutchtown_updated_on( $args = array() )
	{
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		{
			$defaults = array(
				'before_updated_on'	=> '',
				'after_updated_on'	=> ''
			);

			$args = wp_parse_args( $args, $defaults );

			$time_string = '<time class="updated" datetime="%1$s">%2$s</time>';

			$time_string = sprintf( $time_string,
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$updated_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( '%s', 'post date', 'dutchtown' ), $time_string
			);

			echo $args['before_updated_on'] . $updated_on . $args['after_updated_on'];
		}
	}
endif;
?>