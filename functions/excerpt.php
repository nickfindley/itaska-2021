<?php
// https://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt
if ( ! function_exists( 'dutchtown_excerpt' ) )
{
    function dutchtown_excerpt( $dutchtown_excerpt='', $own_line=true, $post_ID = null )
    {
        global $post;
        global $blog_id;
        $raw_excerpt = $dutchtown_excerpt;
        if ( '' == $dutchtown_excerpt )
        {
            $dutchtown_excerpt = get_the_content( $post->ID );
            $dutchtown_excerpt = strip_shortcodes( $dutchtown_excerpt );
            $dutchtown_excerpt = preg_replace('/(<)([img])(\w+)([^>]*>)/', "", $dutchtown_excerpt);
            $dutchtown_excerpt = apply_filters('the_content', $dutchtown_excerpt);
            $dutchtown_excerpt = substr( $dutchtown_excerpt, 0, strpos( $dutchtown_excerpt, '</p>' ) + 4 );
            $dutchtown_excerpt = str_replace( ']]>', ']]&gt;', $dutchtown_excerpt);

            if ( $blog_id == 1 && function_exists( 'tribe_is_event' ) && tribe_is_event() )
            {
                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . sprintf(__( 'Find out more about &ldquo;%s&rdquo;', 'dutchtown' ), get_the_title()) . '</a>&nbsp;<i class="fas fa-caret-right"></i>'; 
            }
            else if ( get_post_type() == 'places' )
            {
                $excerpt_end = '';
            }
            else
            {
                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . sprintf(__( 'Read the rest of &ldquo;%s&rdquo;', 'dutchtown' ), get_the_title()) . '</a>&nbsp;<i class="fas fa-caret-right"></i>'; 
            }

            $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

            $pos = strrpos($dutchtown_excerpt, '</');
            
            if ( $own_line == false )
            {
                if ($pos !== true)
                {
                    $dutchtown_excerpt = substr_replace($dutchtown_excerpt, $excerpt_end, $pos, 0);
                }
            }
            else
            {
                $dutchtown_excerpt .= $excerpt_end;
            }

            return $dutchtown_excerpt;
        }
        else
        {
            if ( ( $blog_id == 1 && function_exists( 'tribe_is_event' ) &&tribe_is_event() ) || get_post_type() == 'places' )
            {
                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . sprintf(__( 'Find out more about &ldquo;%s&rdquo;', 'dutchtown' ), get_the_title()) . '</a>&nbsp;<i class="fas fa-caret-right"></i>'; 
            }
            else
            {
                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . sprintf(__( 'Read the rest of &ldquo;%s&rdquo;', 'dutchtown' ), get_the_title()) . '</a>&nbsp;<i class="fas fa-caret-right"></i>'; 
            }

            $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

            $pos = strrpos($dutchtown_excerpt, '</');
            
            if ( $own_line == false )
            {
                if ($pos !== true)
                {
                    $dutchtown_excerpt = substr_replace($dutchtown_excerpt, $excerpt_end, $pos, 0);
                }
            }
            else
            {
                $dutchtown_excerpt .= $excerpt_more;
            }

            return $dutchtown_excerpt;
        }

        return apply_filters('dutchtown_excerpt', $dutchtown_excerpt, $raw_excerpt);
    }
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'dutchtown_excerpt');

function get_excerpt_by_id($post_id){
    // $the_post = get_post($post_id); //Gets post ID
    // $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    // $excerpt_length = 25; //Sets excerpt length by word count
    // $the_excerpt = strip_shortcodes( $the_excerpt ); //Strips tags and images
    // $the_excerpt = preg_replace('/(<)([img])(\w+)([^>]*>)/', "", $the_excerpt);
    // $the_excerpt = str_replace( ']]>', ']]&gt;', $the_excerpt);
    // // $the_excerpt = rtrim($the_excerpt, "," );
    // $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    $the_post = get_post( $post_id );
    $the_excerpt = $the_post->post_content;
    $the_excerpt = strip_shortcodes( $the_excerpt );
    $the_excerpt = preg_replace('/(<)([img])(\w+)([^>]*>)/', "", $the_excerpt);
    $the_excerpt = apply_filters('the_content', $the_excerpt);
    $the_excerpt = substr( $the_excerpt, 0, strpos( $the_excerpt, '</p>' ) + 4 );
    $the_excerpt = str_replace( ']]>', ']]&gt;', $the_excerpt);

    $the_link = '<a href="' . get_permalink( $post_id ) .'">Find out more about ' . get_the_title( $post_id ) . '</a>&nbsp;<i class="fas fa-caret-right"></i>';
    $the_excerpt =  '<p>' . $the_excerpt . '</p>' . '<p>' . $the_link . '</p>';

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}