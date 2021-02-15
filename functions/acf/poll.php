<?php
if ( function_exists( 'acf_register_block_type' ) ) :
    function dutchtown_acf_init_poll()
    {
        acf_register_block_type(array(
                'name'              => 'dutchtown_poll',
                'title'             => __('Dutchtown Poll'),
                'description'       => __('A custom Dutchtown Poll.'),
                'render_template'   => 'blocks/block-poll.php',
                'category'          => 'formatting',
                'icon'              => 'shortcode',
                'keywords'          => array( 'poll', 'dutchtown' ),
                'supports'          => array ('align' => false ),
                'mode'              => 'edit'
            ));
    }
    add_action( 'acf/init', 'dutchtown_acf_init_poll' );
endif;