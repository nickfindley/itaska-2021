<?php
function dutchtown_poll_form( $category, $answers_allowed )
{
    $poll_responses = new WP_Query(
        array(
            'post_type' => 'poll_response',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'poll_category',
                    'terms' => sanitize_title( $category ),
                    'field' => 'slug'
                )
            )
        )
    );

    if ( $poll_responses->have_posts() ) :
        while ( $poll_responses->have_posts() ) :
            $poll_responses->the_post();
            $field = get_field_object( 'poll_answer' );
            if ( have_rows( 'poll_answer', get_the_ID() ) ) :
                while ( have_rows( 'poll_answer', get_the_ID() ) ) :
                    the_row();
                    $answer_str = string_to_uc( get_sub_field( 'answer', get_the_ID() ) );
                    $answers[] = $answer_str;
                endwhile;
            endif;
        endwhile;
        wp_reset_postdata();
    endif;

    if ( ! empty( $answers ) ):
        $answers = array_filter( $answers );
    endif;

    if ( ! empty( $answers ) ):
        $result = array();

        foreach ( $answers as $val ) :
        $val = trim( $val );
            if ( ! isset( $result[$val] ) ) : // Check if the index exists
                $result[$val] = array();
            endif;
            $result[$val][] = $val;
        endforeach;
    endif;

    if ( ! empty( $result ) ) :
        foreach ( $result as $key => $value ) :
            if ( $key == null ) : continue; endif;
            
            $output .= '<label class="forminator-checkbox" for="' . $key . '">';
            $output .= '<input type="Checkbox" name="checked_answer[]" ';
            $output .= 'id="' . $key . '" value="' . $key . '"> ';
            $output .= '<span aria-hidden="true"></span>';
            $output .= '<span>' . $key . '</span>';
            $output .= '</label>';
            $output .= '</li>';
        endforeach;
    endif;

    $html_before .= '<div class="forminator-row">';
    $html_before .= '<div class="forminator-col forminator-col-12 ">';
    $html_before .= '<div class="forminator-field forminator-acf-repeater">';
    $html_before .= '<input type="hidden" name="poll_category" value="';
    $html_before .= sanitize_title( $category ) . '">';
    $html_before .= $output;

    $html_after = '</div></div></div>';

    if ( $answers_allowed == 1 ) :
        $fields = array( 'field_5fb66cffb0492' ); // show repeater field
    else : 
        $fields = array( 'field_5fcf7cf05a2cc' ); // show hidden decoy field
    endif;

    $args = array(
        'id'                => $slug,
        'post_id'	    	=> 'new_post',
        'new_post'			=> array(
            'post_type'		=> 'poll_response',
            'post_status'   => 'publish',
            'post_title'    => 'Poll Response for ' . $category,
        ),
        'fields'            => $fields,
        'return'			=> home_url( 'ideas' ),
        'submit_value'		=> 'Submit your poll response',
        'html_before_fields' => $html_before,
        'html_after_firleds' => $html_after
    );
    return $args;
}

function dutchtown_save_poll_response( $post_id )
{
    if ( get_post_type( $post_id ) !== 'poll_response' ) : return; endif;
	if ( is_admin() ) : return; endif;
    
	$post = get_post( $post_id );

	if ( ! empty( $_POST['checked_answer'] ) ) :
        for ( $i = 0; $i < count( $_POST['checked_answer'] ); $i++ ) :
            if ( $_POST['checked_answer'][$i] != '' ) :
                $answer_str = string_to_uc( $_POST['checked_answer'][$i] );
                add_row( 'poll_answer', array( 'answer' => $answer_str ), $post_id );
            endif;
        endfor;
    endif;

    $poll_category = $_POST['poll_category'];

    wp_set_post_terms( $post_id, $poll_category, 'poll_category' );
}

add_action('acf/save_post', 'dutchtown_save_poll_response' );