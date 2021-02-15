<?php
    function dutchtown_chartjs()
    {
        if ( is_page( array( 13617 ) ) || is_page_template( 'page-poll.php' ) ) :
            wp_register_script( 'chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js', false, '2.9.4', false );
            wp_enqueue_script( 'chartjs' );
        endif;
    }

    add_action( 'wp', 'dutchtown_chartjs' );
?>