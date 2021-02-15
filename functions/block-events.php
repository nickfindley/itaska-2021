<?php
if ( strpos( get_bloginfo( 'name' ), 'Block' ) ) :
    function cptui_register_my_cpts_block_events() {

        /**
         * Post Type: Block Events.
         */

        $labels = [
            "name" => __( "Block Events", "dutchtown" ),
            "singular_name" => __( "Block Event", "dutchtown" ),
        ];

        $args = [
            "label" => __( "Block Events", "dutchtown" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => "events",
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => [ "slug" => "events", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
            "taxonomies" => [ "category", "post_tag" ],
        ];

        register_post_type( "block_events", $args );
    }

    add_action( 'init', 'cptui_register_my_cpts_block_events' );

    if( function_exists('acf_add_local_field_group') ) :
        acf_add_local_field_group(array(
            'key' => 'group_5ed690f6e1222',
            'title' => 'Block Events',
            'fields' => array(
                array(
                    'key' => 'field_5ed6912376ff8',
                    'label' => 'Block Event Date',
                    'name' => 'block_event_date',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'F jS, Y',
                    'return_format' => 'F jS, Y',
                    'first_day' => 0,
                ),
                array(
                    'key' => 'field_5ed6919f76ffa',
                    'label' => 'Block Event Time',
                    'name' => 'block_event_time',
                    'type' => 'time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'g:ia',
                    'return_format' => 'g:ia',
                ),
                array(
                    'key' => 'field_5ed6915d76ff9',
                    'label' => 'Block Event Location',
                    'name' => 'block_event_location',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '4200 Block of Louisiana',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_5ed691cd76ffb',
                    'label' => 'Block Event Link',
                    'name' => 'block_event_link',
                    'type' => 'url',
                    'instructions' => 'Include a link to a Facebook event page or other website if you have one.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_5ed691f876ffc',
                    'label' => 'Block Event Host',
                    'name' => 'block_event_host',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '4200 Block of Louisiana',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'block_events',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                0 => 'excerpt',
                1 => 'discussion',
                2 => 'comments',
                3 => 'revisions',
                4 => 'format',
                5 => 'send-trackbacks',
            ),
            'active' => true,
            'description' => '',
        ));
    endif;

    // default category for block events
    function dutchtown_default_object_terms( $post_id, $post )
    {
        if ( 'publish' === $post->post_status && $post->post_type === 'block_events' ) :
            $defaults = array(
                'category' => array( 'block-events' )
                );
            $taxonomies = get_object_taxonomies( $post->post_type );
            foreach ( (array) $taxonomies as $taxonomy ) :
                $terms = wp_get_post_terms( $post_id, $taxonomy );
                if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) :
                    wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
                endif;
            endforeach;
        endif;
    }
    add_action( 'save_post', 'dutchtown_default_object_terms', 0, 2 );
endif;
?>