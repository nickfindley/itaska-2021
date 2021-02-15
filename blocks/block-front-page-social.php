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
$body = get_field( 'body' );
$ig = get_field( 'instagram_url' );
$fb = get_field( 'facebook_url' );
$tw = get_field( 'twitter_url' );
$yt = get_field( 'youtube_url' );
?>

<div class="front-page-social">
    <div class="fron-page-social-body">
        <h3><?php echo $title; ?></h3>
        <?php echo $body; ?>
        <div class="front-page-social-icons">
            <div class="social-icon">
                <h4><a href="<?php echo $fb; ?>"><i class="fab fa-facebook"></i><span class="sr-only">Facebook</span></a></h4>
            </div>
            <div class="social-icon">
                <h4><a href="<?php echo $tw; ?>"><i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a></h4>
            </div>
            <div class="social-icon">
                <h4><a href="<?php echo $yt; ?>"><i class="fab fa-youtube"></i><span class="sr-only">YouTube</span></a></h4>
            </div>
            <div class="social-icon">
                <h4><a href="<?php echo $ig; ?>"><i class="fab fa-instagram"></i><span class="sr-only">Instagram</span></a></h4>
            </div>
        </div>
    </div>
</div>