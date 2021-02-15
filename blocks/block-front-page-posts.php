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
$url = get_field( 'posts_url' );
$number = get_field( 'number_of_posts' );
// $fb = get_field( 'facebook_url' );
// $tw = get_field( 'twitter_url' );
?>

<header class="front-page-posts-title">
    <div class="col">
        <h2>
            <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
        </h2>
        <h3><?php the_field( 'body' ); ?><h3>
    </div>
</header>
<div class="masonry-container front-page-posts<?php if ( get_field( 'class' ) ) : echo ' ' . get_field( 'class' ); endif; ?>">
<?php
    $args = array(
        'posts_per_page' => $number,
    );
    $posts_query = new WP_Query( $args );
    if ( $posts_query->have_posts() ) :
        while ( $posts_query->have_posts() ) :
            $posts_query->the_post();
            get_template_part( 'content/post-front-page' );
        endwhile;
    endif;
?>
</div>