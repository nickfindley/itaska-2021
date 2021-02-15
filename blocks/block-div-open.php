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

$block_type = get_field( 'block_type' );

if ( $block_type == 'masonry' ) :
    $class_name .= ' masonry-container';
elseif ( $block_type == 'cards' ) :
    $class_name .= ' cards-wrapper';
endif;
?>

<div class="<?php echo $class_name; ?>" id="<?php echo $id; ?>">
