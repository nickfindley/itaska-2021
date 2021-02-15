<?php
if ( function_exists( 'acf_options_page' ) ) :
    function dutchtown_options_pages()
    {
        acf_add_options_sub_page( array(
            'page_title' => 'Places Settings',
            'menu_title' => 'Places Settings',
            'menu_slug' => 'places-settings',
            'capability' => 'edit_posts',
            'redirect' => false
            )
        );
    }

    add_action( 'acf/init', 'dutchtown_options_pages' );
endif;

if( function_exists( 'acf_add_local_field_group' ) ):
    acf_add_local_field_group( array(
        'key' => 'group_5fb0155b548d2',
        'title' => 'Places Options',
        'fields' => array(
            array(
                'key' => 'field_5fb015625b91f',
                'label' => 'Places Page Title',
                'name' => 'places_page_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5fb015745b920',
                'label' => 'Places Page Pre-Title',
                'name' => 'places_page_pre_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5fb01b934a343',
                'label' => 'Places Page Post-Title',
                'name' => 'places_page_post_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5fb0157d5b921',
                'label' => 'Places Page Content',
                'name' => 'places_page_content',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5fb0158e5b922',
                'label' => 'Places Page Image',
                'name' => 'places_page_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'places-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        )
    );
endif;