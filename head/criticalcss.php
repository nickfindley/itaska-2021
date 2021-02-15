<?php
    echo "<style>";
    if ( tribe_is_month() ) :
        get_template_part( 'criticalcss/calendar' );
    elseif ( get_post_type() == 'places' ) :
        get_template_part( 'criticalcss/places' );
    elseif ( is_archive() ) :
        get_template_part( 'criticalcss/archives' );
    elseif ( is_page( 3788 ) || $post->post_parent == '3788' ) :
        get_template_part( 'criticalcss/dt2' );
    elseif ( is_page( 397 ) || $post->post_parent == '397' ) :
        get_template_part( 'criticalcss/dwna' );
    elseif ( is_page( 12572 ) || $post->post_parent == '12572' ) :
        get_template_part( 'criticalcss/amp' );
    else :
        get_template_part( 'criticalcss/home' );
    endif;
    echo "</style>";
?>