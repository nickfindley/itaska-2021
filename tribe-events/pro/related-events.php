<?php
/**
 * Related Events Template
 * The template for displaying related events on the single event page.
 *
 * You can recreate an ENTIRELY new related events view by doing a template override, and placing
 * a related-events.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/related-events.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$posts = tribe_get_related_posts();

if ( is_array( $posts ) && ! empty( $posts ) ) : ?>

<section class="related-events">
	<header class="related-events-header">
		<h3>Related Events</h3>
	</header>
	<?php foreach ( $posts as $related ) : ?>
	<article id="<?php $related->ID; ?>">
    	<div class="post-article-container">
		<?php if ( has_post_thumbnail() ) : ?>
        <header class="post-header post-has-featured-image">
            <div class="post-header-img">
                <?php echo get_the_post_thumbnail( $related->ID ); ?>
            </div>
            <h2><a href="<?php echo esc_url( get_the_permalink( $related->ID ) ); ?>"><?php echo get_the_title( $related->ID ); ?></a></h2>
		<?php else : ?>
		<header class="post-header">
            <h2><a href="<?php echo esc_url( get_the_permalink( $related->ID ) ); ?>"><?php echo get_the_title( $related->ID ); ?></a></h2>
		<?php endif; ?>
			<section class="post-meta">
                <ul>
                    <?php
                    if ( tribe_is_recurring_event() ) :
                        // $dates = tribe_get_recurrence_start_dates();
                        // $current_date = date('Y-m-d H:i:s');
                        // $found = false;

                        // foreach ( $dates as $i => $d )
                        // {
                        //     if ( ! $found && strcmp( $current_date, $d ) < 0 )
                        //     {
                        //         $found = true;
                        //         $date = date_create( $d );
                        //         $next_date = date_format( $date, 'F jS @ g:ia' );
                        //     }
                        // }

                        echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-menta-expanded">Event on </span><a href="' . tribe_get_event_link( $related ) . '">' . tribe_get_start_date( $related ) . '</a></li>';
                    else :
                        echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-menta-expanded">Event on </span><a href="' . tribe_get_event_link( $related ) . '">' . tribe_get_start_date( $related ) . '</a></li>';
                    endif;
                    if ( tribe_is_recurring_event( $related ) ) : ?>
                    <li><i class="fas fa-fw fa-calendar-alt"></i><a href="<?php echo tribe_all_occurences_link(); ?>">See all instances</a></li>
                    <?php endif;
                    if ( tribe_get_cost() ) : ?><li><i class="fas fa-fw fa-money-bill-alt"></i><?php echo tribe_get_cost( $related->ID, true ) ?></li><?php endif;
                    if ( $venue_link ) : ?><li><i class="fas fa-fw fa-map-marker-alt"></i><?php echo $venue_link; ?></li><?php endif;
                    ?>
                </ul>
                <ul class="post-meta-share-links">
                    <li><i class="fab fa-fw fa-facebook-square"></i><span class="post-meta-expanded">Share on </span><a href="#">Facebook</a></li>
                    <li><i class="fab fa-fw fa-twitter"></i><span class="post-meta-expanded">Tweet on </span><a href="#">Twitter</a></li>
                    <li><i class="fas fa-fw fa-envelope"></i><span class="post-meta-expanded">Send via </span><a href="#">Email</a></li>
                </ul>
            </section>
		</header>
		<?php do_action( 'tribe_events_before_the_content' ) ?>
		<section class="post-content">
            <?php echo get_excerpt_by_id( $related->ID ); ?>
        </section>
	</div>
</article>
		
		
		
		
		
		
		<header class="article-header">
			<h4><a href="<?php echo esc_url( get_the_permalink( $related->ID ) ); ?>" rel="bookmark"><?php echo get_the_title( $related->ID ); ?></a></h4>
		</header>

			<div class="article-img">
		
			<?php
				$thumb = ( has_post_thumbnail( $related->ID ) ) ?
					get_the_post_thumbnail( $related->ID, 'large' ) :
					'<img src="' . get_stylesheet_directory_uri() . '/dist/img/flag.blackyellow.2000x1000.png" alt="' . esc_attr( get_the_title( $related->ID ) ) . '">';
			?>
				<a href="<?php echo esc_url( tribe_get_event_link( $post ) ); ?>" class="url" rel="bookmark"><?php echo $thumb ?></a>
			
			</div><!-- .article-img -->

			<section class="article-meta">
			
				<ul>
					<li><a href="<?php echo get_the_permalink( $related->ID ); ?>"><?php echo tribe_get_start_date( $post ); ?></a></li>
				</ul>
			
			</section><!-- .article-meta -->

			<section class="article-content">
                
				<?php 

				echo get_excerpt_by_id( $related->ID );
				
				?>
				
			</section><!-- .article-content -->
		
		</article>
	<?php endforeach; ?>

	</div><!-- .related-events-wrapper -->

</div><!-- .related-events -->

<?php endif; ?>