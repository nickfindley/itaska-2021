<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'callout-box-' . $block['id'];
if ( ! empty( $block['anchor'])  ) :
    $id = $block['anchor'];
endif;

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = '';
if ( ! empty( $block['class_name'] ) ) :
    $class_name .= ' ' . $block['class_name'];
endif;

if ( ! empty( $block['align'] ) ) :
    $class_name .= ' align-' . $block['align'];
endif;

// Load values and assign defaults.
$title = get_field( 'title' );
$title_link = get_field( 'title_link' );
$body = get_field( 'body' );

if ( get_field( 'color_scheme' ) == 'black_yellow' ) :
    $class_name .= ' black-yellow';
else :
    $class_name .= ' yellow-black';
endif;
?>

<div class="callout-box<?php echo $class_name; ?>">
    <h4>
    <?php
        if ( $title_link ) :
            if ( get_field( 'title_link_stretched' ) ) :
    ?>
        <a class="stretched-link" href="<?php echo $title_link; ?>">
    <?php
            else :
    ?>
        <a href="<?php echo $title_link; ?>">
    <?php
            endif;
        endif;
    ?>
        <?php
            echo $title;

            if ( get_field( 'subtitle' ) ) :
                echo '<span class="subtitle">' . get_field( 'subtitle' ) . '</span>';
            endif;
        ?>
    <?php
        if ( $title_link ) :
    ?>
        </a>
    <?php
        endif;
    ?>
    </h4>
    
    <?php echo $body; ?>
</div>