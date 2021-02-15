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
        <section class="main-meta">
            <ul>
                <li><i class="fas fa-fw fa-clock"></i><span class="post-meta-expanded">Event on </span><a href="<?php the_permalink(); ?>"><?php the_field( 'block_event_date' ); ?></a></li>
                <li><i class="fas fa-fw fa-map-marker-alt"></i><span class="post-meta-expanded">At </span><?php the_field( 'block_event_location' ); ?></li>
            </ul>
            <ul class="main-meta-share-links">
                <?php dutchtown_header_social_links(); ?>
            </ul>
        </section>
    </div>
</header>
<section class="main-content">
    <div class="main-content-container container">
        <?php the_content(); ?>
    </div>
</section>
<div class="main-footer-container container">
    <footer class="main-footer">        
        <?php if ( dutchtown_is_updated() ) : ?><p>
        This post was last updated on <?php dutchtown_updated_on(); ?>.
        </p><?php endif; ?>
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php endif;?>
    </footer>
</div>