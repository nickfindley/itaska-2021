<?php
if ( function_exists( 'acf_register_block_type' ) ) :
    function dutchtown_acf_init_flora_block()
    {
        acf_register_block_type(array(
            'name'              => 'flora_block',
            'title'             => __('Flora Block'),
            'description'       => __('A block featuring the Flora Crown.'),
            'render_template'   => 'blocks/block-flora.php',
            'category'          => 'formatting',
            'icon'              => 'format-image',
            'keywords'          => array( 'block', 'masonry', 'flora' ),
            'supports'          => array ('align' => false ),
            'mode'              => 'edit'
        ));
    }
    add_action('acf/init', 'dutchtown_acf_init_flora_block');
endif;

if ( function_exists('acf_add_local_field_group') ) :
    acf_add_local_field_group(array(
        'key' => 'group_5ff8869d924e3',
        'title' => 'Flora Block Fields',
        'fields' => array(
            array(
                'key' => 'field_5ff886ab7cf2a',
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
                'key' => 'field_5ff886af7cf2b',
                'label' => 'Title Link',
                'name' => 'title_link',
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
                'key' => 'field_5ff8896aea12a',
                'label' => 'Title Link Stretched?',
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
                'key' => 'field_5ff886be7cf2c',
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
                'key' => 'field_5ff886db7cf2d',
                'label' => 'Footer',
                'name' => 'footer',
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
                'key' => 'field_5ff887ac35576',
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
                    'black_yellow' => 'Black background',
                    'yellow_black' => 'Yellow background',
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
                    'value' => 'acf/flora-block',
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