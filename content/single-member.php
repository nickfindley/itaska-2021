<?php
/**
 * Template part for displaying a single regular post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
<header class="main-header main-has-featured-image">
    <div class="main-header-img-container container">
        <div class="main-header-image">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span><?php the_field( 'member_title' ); ?></span></a></h1>
<?php else : ?>
<header class="main-header">
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span><?php the_field( 'member_title' ); ?></span></a></h1>
<?php endif; ?>
    </div>
</header>
<section class="main-content">
    <div class="main-content-container container">
        <?php if ( get_field( 'member_photo' ) ) : ?>
        <div class="member">
            <div class="member-photo">
                <?php $image = get_field( 'member_photo' ); echo wp_get_attachment_image( $image, 'xs', false ); ?>
            </div>
            <div class="member-bio">
                <?php the_field( 'member_bio' ); ?>
            </div>
        </div>
        <?php else : ?>
            <?php the_field( 'member_bio' ); ?>
        <?php endif; ?>
    </div>
</section>
<div class="main-footer-container container">
    <footer class="main-footer">        
        <?php if ( dutchtown_is_updated() ) : ?><p>
        This post was last updated on <?php dutchtown_updated_on(); ?>.
        </p><?php endif; ?>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
    </footer>
</div>