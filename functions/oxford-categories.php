<?php
if ( ! function_exists( 'dutchtown_oxford_categories' ) ) :
	/**
	 * Prints list of categories with links, comma separated,
	 * and with ', and' as the final separator.
	 */
	function dutchtown_oxford_categories( $args = array() )
	{
        global $blog_id;
        
		$defaults = array(
			'before_categories'		=> '',
			'after_categories'		=> '',
			'before_link'			=> '',
			'after_link'			=> '',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( $blog_id == 1 && function_exists( 'tribe_is_event' ) && tribe_is_event() )
        {
            $cats = get_the_terms( get_the_ID(), 'tribe_events_cat' );	
        }
		else if ( get_post_type() == 'places' )
		{
			$cats = get_the_terms( get_the_ID(), 'place_category' );
		}
		else
		{
			$cats = get_the_category();
		}
		
		if ( ! empty( $cats ) )
		{
			for ( $i = 0; $i < count($cats); $i++ )
			{
				$output[$i] = $args['before_link'] . '<a href="' . get_term_link( $cats[$i]->term_id );
                if ( $blog_id == 1 && function_exists( 'tribe_is_event' ) && tribe_is_event() ) :
                    $output[$i] .= 'list/';
                endif;
                $output[$i] .= '">' . $cats[$i]->name . '</a>' . $args['after_link'];
			}

			echo $args['before_categories'] . wp_sprintf_l('%l', $output) . $args['after_categories'];
		}
	}
endif;
?>