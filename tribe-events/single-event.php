<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

global $post;

$venue_id = tribe_get_venue_id();
$venue_name = strip_tags( tribe_get_venue() );

if ( ! empty ( get_field( 'place_url', $venue_id ) ) ) :
	$venue_url = get_field( 'place_url', $venue_id );
	$venue_link = '<a href="' . $venue_url . '">' . $venue_name .'</a>';

elseif ( ! empty ( get_field( 'place_id', $venue_id ) ) ) : 
	$venue_url = get_permalink( get_field( 'place_id', $venue_id ) );
	$venue_link = '<a href="' . $venue_url . '">' . $venue_name .'</a>';

else :
	$args = array(
		'post_type' => 'places',
		'posts_per_page' => 1,
		'title' => $venue_name
	);
	$query = new WP_Query($args);
	if ( $query->have_posts() ) :
		if ( $query->post_count == 1 ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$venue_url = get_permalink( get_the_ID() );
				$venue_link = '<a href="' . $venue_url . '">' . $venue_name .'</a>';
			endwhile;
		endif;
	else :
		$venue_link = tribe_get_venue_link();
	endif;
	wp_reset_query();
endif;
?>

<main class="main-single-event">
	<article>
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
				<section class="main-meta">
					<ul>
						<?php
						// if ( tribe_is_recurring_event() ) :
						// 	$dates = tribe_get_recurrence_start_dates();
						// 	$current_date = date('Y-m-d H:i:s');
						// 	$found = false;

						// 	foreach ( $dates as $i => $d ) :
						// 		if ( ! $found && strcmp( $current_date, $d ) < 0 ) :
						// 			$found = true;
						// 			$date = date_create( $d );
						// 			$next_date = date_format( $date, 'F jS @ g:ia' );
						// 		endif;
						// 	endforeach;

						// 	if ( isset( $next_date ) ) :
                        //         echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-meta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . $next_date . '</a></li>';
                        //     endif;
						// else :
							echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-meta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . tribe_get_start_date() . '</a></li>';
						// endif;
						if ( tribe_is_recurring_event() ) : ?>
						<li><i class="fas fa-fw fa-calendar-alt"></i><a href="<?php echo tribe_all_occurences_link(); ?>">See all instances</a></li>
						<?php endif;
						if ( tribe_get_cost() ) : ?><li><i class="fas fa-fw fa-money-bill-alt"></i><?php echo tribe_get_cost( null, true ) ?></li><?php endif; ?>
                    </ul>
                    <?php
						if ( $venue_link ) : ?><ul class="main-meta-location"><li><i class="fas fa-fw fa-map-marker-alt"></i><span class="post-meta-expanded">At </span><?php echo $venue_link; ?></li></ul><?php endif;
                    ?>
					<ul class="main-meta-share-links">
						<?php dutchtown_header_social_links(); ?>
					</ul>
				</section>
			</div>
		</header>
		<?php while ( have_posts() ) :  the_post(); ?>
		<section class="main-content">
			<div class="main-content-container container">
				<?php tribe_the_notices() ?>
				<?php the_content(); ?>
			</div>
		</section>
		<section class="main-event-meta container">
			<?php tribe_get_template_part( 'modules/meta' ); ?>
		</section>
		<?php endwhile; ?>
		<nav class="pagination-container container">
			<ul class="pagination">	
				<li class="page-item event-nav-previous">
				<?php
					$event_previous = Tribe__Events__Main::instance()->get_closest_event( $post, 'previous' );
					echo '<a class="page-link" href="' . get_the_permalink( $event_previous->ID ) . '"><i class="fas fa-caret-left"></i> <span>Previous event: </span>' . $event_previous->post_title . '</a>';
				?>
				</li>
				<li class="page-item event-nav-next">
				<?php
					$event_next = Tribe__Events__Main::instance()->get_closest_event( $post, 'next' );
					echo '<a class="page-link" href="' . get_the_permalink( $event_next->ID ) . '"><span>Next event: </span>' . $event_next->post_title . ' <i class="fas fa-caret-right"></i></a>';
				?>
				</li>
			</ul>			
		</nav>
		<div class="main-footer-container container">
			<footer class="main-footer">        
				<?php $category = get_primary_taxonomy_term( get_the_ID(), 'tribe_events_cat' ); ?>
                <p class="categories">Filed under <span class="collapse collapse-cat show" id="primaryCategory<?php echo get_the_ID(); ?>"><a href="<?php echo $category['url']; ?>"><?php echo $category['title']; ?></a>. <a href="#" data-toggle="collapse" data-target=".collapse" aria-expanded="true" aria-controls="primaryCategory allCategories">Show all categories</a>.</span> <span class="collapse collapse-cat" id="allCategories<?php echo get_the_ID(); ?>"><?php dutchtown_oxford_categories(); ?>.  <a href="#" data-toggle="collapse" data-target=".collapse" aria-expanded="false" aria-controls="primaryCategory<?php echo get_the_ID(); ?> allCategories<?php echo get_the_ID(); ?>">Show fewer categories</a>.</span></p>
				
				<p><?php dutchtown_footer_social_links( 'Share this event on' ); ?>
				<?php if ( dutchtown_is_updated() ) : ?>
				This event was last updated on <?php dutchtown_updated_on(); ?>.
				<?php endif; ?></p>
				<?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php endif; ?>
			</footer>
		</div>
	</article>
</main>