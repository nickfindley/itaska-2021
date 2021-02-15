<?php
/**
 * Template part for displaying a page of UrbanMain Steering Committee Members
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
            <?php the_post_thumbnail(); ?>
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
<section class="main-content container">
    <?php the_content(); ?>
</section>
<section class="main-content card-container">
    <ul class="card-deck">
    <?php
        $args = array(
            'post_type' => 'steering_committee',
            'meta_query' => array(
                array( 'key' => 'member_last_name' )
            ),
            'orderby' => array(
                'member_last_name' => 'DESC',
            ),
            'posts_per_page' => -1,
        );
        $member_query = new WP_Query( $args );
        if ( $member_query->have_posts() ) :
            while ( $member_query->have_posts() ) :
                $member_query->the_post();
    ?>
        <li class="card">
            <div class="card-body">
                <?php if ( get_field( 'member_photo' ) ) : $image = get_field( 'member_photo' ); echo wp_get_attachment_image( $image, 'xs', false, array( 'class' => 'card-img-top' ) ); endif; ?>
                <h4 class="card-title"><?php the_title(); ?></h4>
                <?php if ( get_field( 'member_organization' ) ) : ?>
                <p class="card-text"><?php if ( get_field( 'member_organization_link' ) ) : ?><a href="<?php the_field( 'member_organization_link' ); ?>"><?php endif; ?><?php the_field( 'member_organization' ); ?><?php if ( get_field( 'member_organization_link' ) ) : ?></a><?php endif; ?></p>
                <?php endif; ?>       
                <div class="card-footer">
                   <?php if ( get_field( 'member_bio_link' ) ) : ?>
                   <a href="<?php the_field( 'member_bio_link' ); ?>">Read <?php the_field( 'member_first_name' ); ?>&apos;s bio</a>
                   <?php endif;?> 
                </div>
            </div>
        </li>
    <?php
            endwhile;
            wp_reset_postdata();
        endif;
    ?>
    </ul>
</section>
<div class="main-footer-container container">
    <footer class="main-footer">
        <?php if ( ! is_page( array( 'contact', 'mailing-list', 'volunteer' ) ) ) : ?><p><?php dutchtown_footer_social_links( 'Share this page on' ); ?><?php if ( dutchtown_is_updated() ) : ?> This page was last updated on <?php dutchtown_updated_on(); ?>.<?php endif; ?></p><?php endif; ?>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
    </footer>
</div>