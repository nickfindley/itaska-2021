<?php
if ( function_exists( 'acf_register_block_type' ) ) :
    function dutchtown_acf_init_callout_box()
    {
        acf_register_block_type(array(
                'name'              => 'dutchtown_callout_box',
                'title'             => __('Dutchtown Callout Box'),
                'description'       => __('At box to display prominent info.'),
                'render_template'   => 'blocks/block-callout-box.php',
                'category'          => 'formatting',
                'icon'              => 'block',
                'keywords'          => array( 'callout', 'box', 'dutchtown' ),
                'supports'          => array ('align' => true ),
                'mode'              => 'edit'
            ));
    }
    add_action( 'acf/init', 'dutchtown_acf_init_callout_box' );
endif;

if ( function_exists( 'acf_add_local_field_group' ) ):
    acf_add_local_field_group( array(
        'key' => 'group_6002f0664e2b1',
        'title' => 'Callout Box Fields',
        'fields' => array(
            array(
                'key' => 'field_6002f07590e58',
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
                'key' => 'field_6002f0d190e5c',
                'label' => 'Subtitle',
                'name' => 'subtitle',
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
                'key' => 'field_6002f07c90e59',
                'label' => 'Title Link',
                'name' => 'title_link',
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
                'key' => 'field_6002f08490e5a',
                'label' => 'Title Link Stretched',
                'name' => 'title_link_stretched',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_6002f09790e5b',
                'label' => 'Body',
                'name' => 'body',
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
                'key' => 'field_6002f14290e5d',
                'label' => 'Color Scheme',
                'name' => 'color_scheme',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'black_yellow' => 'Yellow on Black',
                    'yellow_black' => 'Black on Yellow',
                ),
                'default_value' => 'black_yellow',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/dutchtown-callout-box',
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