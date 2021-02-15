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
        <div class="row">
            <div class="dt2-content">
                <?php the_content(); ?>
            </div>

            <div class="dt2-events">
                <h2>
                    Upcoming DT2 Events
                    <span class="subtitle">More events at <a href="https://www.dutchtownstl.org/calendar/">dutchtownstl.org/calendar</a></span>
                </h2>
                <?php
                switch_to_blog( 1 );
                $upcoming_events = new WP_Query( array(
                    'post_type' => array(Tribe__Events__Main::POSTTYPE),
                    'eventDisplay' => 'list',
                    'posts_per_page' => 4,
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
                        get_template_part( 'content/item-event-compact' );
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?><p>There are no DT2 events currently scheduled.</p><?php
                endif;
                restore_current_blog();
                ?>

                <p class="all-events"><a href="/calendar/category/dutchtown-cid/list/">See all DT2 events</a> <i class="fas fa-caret-right"></i></p>
            </div>
        </div>

        <div class="row">
            <div class="dt2-news">
                <h2>
                    DT2 News
                    <span class="subtitle">Find more DT2 updates at <a href="https://www.dutchtownstl.org/news/">dutchtownstl.org/news</a></span>
                </h2>
                <div class="masonry-container front-page-posts">
                <?php
                    $args = array(
                        'posts_per_page' => 4,
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
            </div>
        </div>
    </div>
</section>