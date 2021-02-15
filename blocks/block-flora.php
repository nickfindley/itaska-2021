<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'flora-block-' . $block['id'];
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
    $class_name .= ' card-black-yellow';
else :
    $class_name .= ' card-yellow-black';
endif;
?>

<div class="card-wrapper<?php echo $class_name; ?>">
    <div class="card card-flora">
        <div class="card-body">
            <div class="card-body-wrapper">
                <h3 class="card-title">
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
                    <?php echo $title; ?>
                <?php
                    if ( $title_link ) :
                ?>
                    </a>
                <?php
                    endif;
                ?>
                </h3>
                <div class="card-text">
                    <?php echo $body; ?>
                </div>
            </div>
        </div>
    <?php
        if ( get_field( 'footer' ) ) :
    ?>
        <div class="card-footer">
            <?php the_field( 'footer' ); ?>
        </div>
    <?php
        endif;
    ?>
    </div>
</div>