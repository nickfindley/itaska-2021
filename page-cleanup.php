<?php
/**
 * Template Name: Cleanup Events Template
 * The template for cleanup events pulled from the main calendar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-dt2" id="content">
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
        <?php if ( ! is_page( array( 'contact', 'list', 'volunteer' ) ) ) : ?>
            <section class="main-meta">
                <ul>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        <?php endif; ?>
        </div>
    </header>
    <section class="main-content">
        <div class="main-content-container container">
            <?php the_content(); ?>
        </div>
    </section>
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
                'terms' => 'cleanups'
            )
        )
    ));
    if ( $upcoming_events->have_posts() ) :
    ?>
        <header class="container">
            <h2>Upcoming Cleanups</h2>
        </header>
    <?php
        while ( $upcoming_events->have_posts() ) :
            $upcoming_events->the_post();
            get_template_part( 'content/item-event' );
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</main>
<?php get_footer(); ?>