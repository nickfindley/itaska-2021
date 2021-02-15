<?php
/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 */

if ( ! tribe_get_venue_id() ) {
	return;
}

global $post;

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_url();
$website_parse = parse_url( $website );
$website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST));

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
<h3><span class="venue-extended">Location<span class="sr-only">:</span> </span><?php echo $venue_link; ?></h3>
<dl>
	<?php if ( tribe_address_exists() ) : ?>
		<dt><i class="fas fa-fw fa-map-marker-alt"></i> Address</dt>
		<dd>
			<address>
				<?php echo tribe_get_full_address(); ?>
			</address>
		</dd>
	<?php endif; ?>

	<?php if ( ! empty( $phone ) ): ?>
		<dt><i class="fas fa-fw fa-phone-square"></i> <?php esc_html_e( 'Phone', 'the-events-calendar' ); ?></dt>
		<dd><a href="tel:<?php echo esc_html( $phone ); ?>" title="Initiate telephone call to <?php echo $venue_name; ?>"><?php echo esc_html( $phone ); ?></a></dd>
	<?php endif ?>

	<?php if ( ! empty( $website ) ): ?>
		<dt><i class="fas fa-fw fa-external-link-alt"></i>  <?php esc_html_e( 'Website', 'the-events-calendar' ) ?> </dt>
		<dd><a href="<?php echo $website; ?>"><?php echo $website_host; ?></a></dd>
	<?php endif ?>
</dl>