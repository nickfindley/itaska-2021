<?php
global $blog_id;
if ( $blog_id == 1 ) : 
    function dutchtown_register_site_notices() {

        /**
         * Post Type: Site Notices.
         */

        $labels = [
            "name" => __( "Site Notices", "dutchtown" ),
            "singular_name" => __( "Site Notice", "dutchtown" ),
        ];

        $args = [
            "label" => __( "Site Notices", "dutchtown" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => false,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => false,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => [ "slug" => "site-notices", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "custom-fields" ]
        ];

        register_post_type( "site_notices", $args );
    }

    add_action( 'init', 'dutchtown_register_site_notices' );

    if ( function_exists('acf_add_local_field_group') )
    {
        acf_add_local_field_group(array(
            'key' => 'group_5edb745877c14',
            'title' => 'Site Notice Fields',
            'fields' => array(
                array(
                    'key' => 'field_5edb7ace219f4',
                    'label' => 'Site Notice Text',
                    'name' => 'site_notice_text',
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
                    'key' => 'field_5edb74e42e25a',
                    'label' => 'Action Button Label',
                    'name' => 'action_button_label',
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
                    'key' => 'field_5edb75042e25b',
                    'label' => 'Action Label Link',
                    'name' => 'action_label_link',
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
                    'key' => 'field_5edb751a2e25c',
                    'label' => 'Site Notice Expire Date',
                    'name' => 'site_notice_expire_date',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'Y-m-d',
                    'return_format' => 'Y-m-d',
                    'first_day' => 0,
                ),
                array(
                    'key' => 'field_5edb75552e25d',
                    'label' => 'Site Notice Disable',
                    'name' => 'site_notice_disable',
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
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'site_notices',
                    ),
                ),
            ),
            'menu_order' => -1,
            'position' => 'acf_after_title',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                0 => 'permalink',
                1 => 'excerpt',
                2 => 'discussion',
                3 => 'comments',
                4 => 'revisions',
                5 => 'slug',
                6 => 'author',
                7 => 'format',
                8 => 'page_attributes',
                9 => 'featured_image',
                10 => 'send-trackbacks',
                11 => 'content'
            ),
            'active' => true,
            'description' => '',
        ));
    }
endif;

function dutchtown_site_notice()
{
	if ( is_admin() ) :
		return;
	endif;

    global $blog_id;
    if ( $blog_id !== 1 ) : switch_to_blog( 1 ); endif;
    $args = array(
        'post_type' => 'site_notices',
        'orderby' => 'publish_date',
        'order' => 'DESC',
        'posts_per_page' => 5,
    );
    if ( $blog_id !== 1 ) : restore_current_blog(); endif;
    $site_notice_query = new WP_Query( $args );
    if ( $site_notice_query->have_posts() ) :
        while ( $site_notice_query->have_posts() ) :
            $site_notice_query->the_post();
            $text = get_field( 'site_notice_text' );
            $cookie_name = 'siteNotice' . get_the_ID();
            $cookie_value = esc_attr( md5( $text ) );
            $notice_date = strtotime( get_the_date( 'Y-m-d' ) );
            $current_date = date( 'Y-m-d' );
            if ( get_field( 'site_notice_expire_date' ) ) :
                $expire_date = get_field( 'site_notice_expire_date' );
            else :
                $expire_date = strtotime( $current_date . ' +1 day' );
            endif;
            $ninety_days = strtotime( $current_date . '- 90 days' );
            $ninety_days = strtotime( date( 'Y-m-d', $ninety_days ) );
            if ( $notice_date > $ninety_days ) :
                if ( $expire_date > $current_date ) :
                    if ( ! isset( $_COOKIE[$cookie_name] ) || $_COOKIE[$cookie_name] != $cookie_value ) :
            ?>
        <div class="site-notice" data-cookie-name="<?php echo $cookie_name; ?>" data-cookie-value="<?php echo $cookie_value; ?>">
            <div class="container">
                <div class="site-notice-content">
                    <span class="site-notice-text"><?php echo $text; ?></span>
                    <?php
                        if ( get_field( 'action_label_link' ) ) : 
                            $action_button_link = get_field( 'action_label_link' );
                        else :
                            $action_button_link = '#';
                        endif;
                    ?>
                    <a class="btn action-btn" href="<?php echo $action_button_link; ?>"><?php the_field( 'action_button_label' ); ?></a></div>
                <button aria-label="<?php esc_html_e( 'Dismiss site notice', 'dutchtown' ); ?>" class="site-notice-dismiss">×</button>
            </div>
        </div>
        <?php
                        break;
                    endif;
                endif;
            endif;
        endwhile;
    endif;
    restore_current_blog();
    wp_reset_postdata();
}
?>