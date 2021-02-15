<?php
if ( ! empty( $block['anchor'])  ) :
    $id = $block['anchor'];
elseif ( get_field( 'block_anchor' ) ) :
    $id = get_field( 'block_anchor' );
else : 
    $id = 'block-' . $block['id'];
endif;

if ( ! empty( $block['class_name'] ) ) :
    $class_name .= ' ' . $block['class_name'];
else : 
    $class_name = '';
endif;

if ( ! empty( $block['align'] ) ) :
    $class_name .= ' align-' . $block['align'];
endif;

$category = get_field( 'poll_category' )->name;
$answers_allowed = get_field( 'poll_answers_allowed' );
$poll_result_style = get_field( 'poll_result_style' );
$poll_result_max_results = get_field( 'poll_result_max_results' );
?>

<h2><?php the_field( 'poll_title' ); ?></h2>
<?php
    if ( get_field( 'poll_description' ) ) : 
        the_field( 'poll_description' );
    endif;

acf_form( dutchtown_poll_form( $category, $answers_allowed ) );
dutchtown_poll_results( $category, $poll_result_style, $poll_result_max_results );