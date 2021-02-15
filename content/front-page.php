<?php
/**
 * Template part for displaying a single regular page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
<header class="main-header main-has-featured-image">
    <div class="main-header-image-container container">
        <div class="main-header-image">
            <?php the_post_thumbnail( 'xl', ['class' => 'no-lazyload']); ?>
        </div>
    </div>
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php else : ?>
<header class="main-header">
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php endif; ?>
    </div>
</header>
<section class="main-content">
    <div class="main-content-container container">
        <?php the_content(); ?>
    </div>
</section>