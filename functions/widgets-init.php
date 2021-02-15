<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if ( ! function_exists( 'dutchtown_widgets_init' ) ) :
	function dutchtown_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer One', 'dutchtown' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'dutchtown' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Two', 'dutchtown' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'dutchtown' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Three', 'dutchtown' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'dutchtown' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}
endif;
add_action( 'widgets_init', 'dutchtown_widgets_init' );

class My_Text_Widget extends WP_Widget_Custom_HTML {
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
        echo $before_widget;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
        <?php
        echo $after_widget;
    }
}
?>