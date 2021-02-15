<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'masonry-block-' . $block['id'];
if ( ! empty( $block['anchor'])  ) :
    $id = $block['anchor'];
endif;

// Create class attribute allowing for custom "className" and "align" values.
$className = '';
if ( ! empty( $block['className'] ) ) :
    $className .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
    $className .= ' align-' . $block['align'];
endif;

// Load values and assign defaults.
$title = get_field( 'title' );
$title_link = get_field( 'title_link' );
$body = get_field( 'body' );
$image = get_field( 'image' );
?>

<div class="masonry-block">
    <div class="card">
        <?php
            if ( $image ) : 
                echo '<div class="card-image">';
                echo wp_get_attachment_image( $image, 'medium', false, array( 'class' => 'card-img-top' ) );
                echo '</div>';
            endif;
        ?>
        <div class="card-body">
        <?php
            if ( $title_link ) :
                echo '<h3><a href="' . $title_link . '">' . $title . '&nbsp;<i class="fas fa-link"></i></a></h3>';
            else : 
                echo '<h3>' . $title . '</h3>';
            endif;

            echo $body; 
        ?>
        </div>
    </div>
</div>