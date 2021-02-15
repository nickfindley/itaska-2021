<?php
if ( function_exists( 'acf_register_block_type' ) ) :
    function dutchtown_acf_init_div_open_close()
    {
        acf_register_block_type(array(
                'name'              => 'div_open',
                'title'             => __('Div Open'),
                'description'       => __('Opening div for containers of blocks.'),
                'render_template'   => 'blocks/block-div-open.php',
                'category'          => 'formatting',
                'icon'              => 'shortcode',
                'keywords'          => array( 'div', 'row', 'masonry', 'card', 'open' ),
                'supports'          => array ('align' => false ),
                'mode'              => 'edit'
            ));

            acf_register_block_type(array(
                'name'              => 'div_close',
                'title'             => __('Div Close'),
                'description'       => __('Closing div to correspond with open blocks.'),
                'render_template'   => 'blocks/block-div-close.php',
                'category'          => 'formatting',
                'icon'              => 'shortcode',
                'keywords'          => array( 'div', 'row', 'masonry', 'card', 'close' ),
                'supports'          => array ('align' => false ),
                'mode'              => 'preview'
            ));
    }
    add_action('acf/init', 'dutchtown_acf_init_div_open_close');
endif;

if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_5fa3e00373bd8',
        'title' => 'Div Open Fields',
        'fields' => array(
            array(
                'key' => 'field_5fa3e00d72d42',
                'label' => 'Block Type',
                'name' => 'block_type',
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
                    'cards' => 'Cards',
                    'masonry' => 'Masonry',
                    'other' => 'Other',
                ),
                'default_value' => false,
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5fa3e352469a4',
                'label' => 'Block Anchor',
                'name' => 'block_anchor',
                'type' => 'text',
                'instructions' => 'Don\'t include the "#", just the anchor text.',
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
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/div-open',
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

    acf_add_local_field_group(array(
        'key' => 'group_5fa3e6b9cb3bc',
        'title' => 'Div Close Fields',
        'fields' => array(
            array(
                'key' => 'field_5fa3e6c279f50',
                'label' => 'Block Closing Comment',
                'name' => 'block_closing_comment',
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
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/div-close',
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