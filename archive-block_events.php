<?php
/**
 * The template file for displaying block event archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-archive" id="content">
    <header class="main-header">
		<div class="main-header-container container">
			<h1><?php the_archive_title(); ?></h1>
		</div>
    </header>
	<div class="archive-container container">
        <div class="archive-time">
            <section class="archive-past-posts">
			<?php
            // $event_date = get_field( 'block_event_date', false, false );
            $today = date( 'Y-m-d' );
			$args = array(
                'post_type' => 'block_events',
                'meta_key' => 'block_event_date',
                'meta_query' => array(
                    'key' => 'block_event_date',
                    'value' => $today,
                    'type' => 'date',
                    'compare' => '>='
                ),
                'orderby' => array(
                    'block_event_date' => 'ASC'
                ),
                'posts_per_page' => -1,
            );
            $block_event_query = new WP_Query( $args );
            if ( $block_event_query->have_posts() ) :
                while ( $block_event_query->have_posts() ) :
                    $block_event_query->the_post();
                    get_template_part( 'content/archive-block-event' );
                endwhile;
            else :
            ?>
                <article>
                    <div class="item-container container">
                        <header class="item-header">
                            <h2>Upcoming Events</h2>
                        </header>
                        <section class="item-content">
                            <p>There are no events scheduled at this time.</p>
                        </section>
                    </div>
                </article>
            <?php
                endif;
			?>
			</section>
			<section class="archive-time-list">
                <header class="archive-time-list-header">
                    <h2>Past Events</h2>
                </header>
                <ul class="list-unstyled"><?php 
                    $args = array(
                        'post_type' => 'block_events',
                        'meta_key' => 'block_event_date',
                        'meta_query' => array(
                            'key' => 'block_event_date',
                            'value' => $today,
                            'type' => 'date',
                            'compare' => '<'
                        ),
                        'orderby' => array(
                            'block_event_date' => 'DESC'
                        ),
                        'posts_per_page' => -1,
                    );
                    $block_event_query = new WP_Query( $args );
                    if ( $block_event_query->have_posts() ) :
                        echo '<dl>';
                        while ( $block_event_query->have_posts() ) :
                            $block_event_query->the_post();
                            ?>
                            <dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
                            <dd><?php the_field( 'block_event_date' ); ?></dd><?php
                        endwhile;
                    endif;
                ?></ul>
            </section>
        </div>
    </div>
	<div class="main-footer-container container">
        <footer class="main-footer">
            <?php if ( function_exists('yoast_breadcrumb') ) : ?>
            <p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p>
            <?php endif;?>
        </footer>
    </div>
</main>
<?php get_footer(); ?>