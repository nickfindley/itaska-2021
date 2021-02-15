<?php
if ( function_exists( 'acf_register_block_type' ) ) :
    function dutchtown_acf_init_front_page_posts()
    {
        acf_register_block_type(array(
            'name'              => 'front_page_posts',
            'title'             => __('Front Page Posts'),
            'description'       => __('Display blog posts on the front page.'),
            'render_template'   => 'blocks/block-front-page-posts.php',
            'category'          => 'formatting',
            'keywords'          => array( 'front page', 'posts' ),
            'supports'          => array ('align' => false ),
            'mode'              => 'edit'
        ));
    }
    add_action('acf/init', 'dutchtown_acf_init_front_page_posts');
endif;

if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_5f405c72bb23b',
        'title' => 'Front Page Posts',
        'fields' => array(
            array(
                'key' => 'field_5f405c7978bbd',
                'label' => 'Title',
                'name' => 'title',
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
                'key' => 'field_5f405c8078bbe',
                'label' => 'Body',
                'name' => 'body',
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
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5f405cf08e0cd',
                'label' => 'Posts URL',
                'name' => 'posts_url',
                'type' => 'url',
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
            ),
            array(
                'key' => 'field_5f405c8f78bbf',
                'label' => 'Number of Posts',
                'name' => 'number_of_posts',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 3,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => 1,
                'max' => 10,
                'step' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/front-page-posts',
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
    ));
endif;