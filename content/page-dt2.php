<?php
/**
 * Template part for displaying a single DT2 page
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
        <?php if ( is_page( 3788 ) ) : ?>
        <h1 class="sr-only"><a href="<?php the_permalink(); ?>">DT2 • Downtown Dutchtown</a></h1>
        <?php else : ?>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>
<?php else : ?>
<header class="main-header">
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php endif; ?>
    </div>
    <nav class="dt2-nav">
        <div class="dt2-nav-container">
            <ul class="nav nav-tabs" id="dt2Tabs" role="navigation">
                <li class="nav-item"><a class="nav-link <?php if ( is_page( 3788 ) ) : ?>active<?php endif; ?>" href="/dt2/">About</a></li>
                <li class="nav-item"><a class="nav-link <?php if ( is_page( 3791 ) ) : ?>active<?php endif; ?>" href="/dt2/donate/">Donate</a></li>
                <li class="nav-item"><a class="nav-link <?php if ( is_page( 3793 ) ) : ?>active<?php endif; ?>" href="/dt2/board/">Board</a></li>
                <li class="nav-item"><a class="nav-link <?php if ( is_page( 12629 ) ) : ?>active<?php endif; ?>" href="/dt2/events/">Events</a></li>
                <li class="nav-item"><a class="nav-link <?php if ( is_page( 3800 ) ) : ?>active<?php endif; ?>" href="/dt2/contact/">Contact</a></li>
            </ul>
        </div>
    </nav>
</header>
<section class="main-content container">
    <?php the_content(); ?>
</section>
<?php
if ( is_page( 3788 ) ) :
    $args = array(
        'category_name' => 'dt2',
    );
    $news_query = new WP_Query( $args );
    if ( $news_query->have_posts() ) :
?>
<section class="main-content dt2-news">
    <header class="dt2-news-header container">
        <h2>Recent DT2 News</h2>
    </header> 
<?php
        while ( $news_query->have_posts() ) :
            $news_query->the_post();
            get_template_part( 'content/post-excerpt' );
        endwhile;
        wp_reset_postdata();
?>
</section>
<?php
    endif;
endif;
?>
<?php if ( is_page( 3793 ) ) : ?>
<section class="main-content card-container">
    <ul class="card-deck">
    <?php
        $args = array(
            'post_type' => 'board_member',
            'meta_query' => array(
                array( 'key' => 'member_order' ),
                array( 'key' => 'member_last_name' ),
            ),
            'orderby' => array(
                'member_order' => 'ASC',
                'member_last_name' => 'DESC',
            ),
            'posts_per_page' => -1,
        );
        $board_query = new WP_Query( $args );
        if ( $board_query->have_posts() ) :
            while ( $board_query->have_posts() ) :
                $board_query->the_post();
    ?>
        <li class="card">
            <div class="card-body">
                <!--<?php if ( get_field( 'member_photo' ) ) : $image = get_field( 'member_photo' ); echo wp_get_attachment_image( $image, 'xs', false, array( 'class' => 'card-img-top' ) ); endif; ?>-->
                <h4 class="card-title"><?php the_title(); ?></h4>
                <p class="card-text"><?php the_field( 'member_title' ); ?></p>
                <?php if ( get_field( 'member_organization' ) ) : ?><div class="card-footer"><p><?php if ( get_field( 'member_organization_link' ) ) : ?><a href="<?php the_field( 'member_organization_link' ); ?>"><?php endif; ?><?php the_field( 'member_organization' ); ?><?php if ( get_field( 'member_organization_link' ) ) : ?></a><?php endif; ?></div><?php endif; ?>
            </div>
        </li>
    <?php
            endwhile;
            wp_reset_postdata();
        endif;
    ?>
    </ul>
<?php endif; ?>
</section>
<?php if ( is_page( 12629 ) ) : ?>
<section class="dt2-events">
<?php
    $upcoming_events = new WP_Query( array(
        'post_type' => array(Tribe__Events__Main::POSTTYPE),
        'eventDisplay' => 'list',
        'posts_per_page' => -1,
        'meta_key'=>'_EventStartDate',
        'orderby'=>'_EventStartDate',
        'order'=>'ASC',
        'tribeHideRecurrence' => true,
        'tax_query' => array(
            array(
                'taxonomy' => Tribe__Events__Main::TAXONOMY,
                'field' => 'slug',
                'terms' => 'dt2'
            )
        )
    ));
    if ( $upcoming_events->have_posts() ) :
        while ( $upcoming_events->have_posts() ) :
            $upcoming_events->the_post();
            get_template_part( 'content/item-event' );
        endwhile;
        wp_reset_postdata();
    else :
        ?><p>There are no DT2 events currently scheduled.</p><?php
    endif;
?>
</section>
<?php endif; ?>
<div class="main-footer-container container">
    <footer class="main-footer">
        <?php if ( ! is_page( array( 'contact', 'mailing-list', 'volunteer' ) ) ) : ?><p><?php dutchtown_footer_social_links( 'Share this page on' ); ?><?php if ( dutchtown_is_updated() ) : ?> This page was last updated on <?php dutchtown_updated_on(); ?>.<?php endif; ?></p><?php endif; ?>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
    </footer>
</div>