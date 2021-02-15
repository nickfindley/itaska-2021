<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
 *
 * @package TribeEventsCalendar
 * @version 4.4
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

foreach ( $organizer_ids as $organizer ) {
	if ( ! $organizer ) {
		continue;
	}

    $organizer_id = get_the_id( $organizer );
	$organizer_name = get_the_title( $organizer );
    $phone = tribe_get_organizer_phone( $organizer );
    $email = tribe_get_organizer_email( $organizer );
    $website = tribe_get_organizer_website_url( $organizer );
    $website_parse = parse_url( $website );
    $website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST));

	if ( ! empty ( get_field( 'place_url', $organizer ) ) ) :
		$organizer_url = get_field( 'place_url', $organizer );
		$organizer_link = '<a href="' . $organizer_url . '">' . $organizer_name .'</a>';

	elseif ( ! empty ( get_field( 'place_id', $organizer_id ) ) ) : 
		$organizer_url = get_permalink( get_field( 'place_id', $organizer_id ) );
		$organizer_link = '<a href="' . $organizer_url . '">' . $organizer_name .'</a>';

	else :
		$args = array(
			'post_type' => 'places',
			'posts_per_page' => 5,
			'title' => $organizer_name
		);
		$query = new WP_Query($args);
		if ( $query->have_posts() ) :
			if ( $query->post_count == 1 ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					$organizer_url = get_permalink( get_the_ID() );
					$organizer_link = '<a href="' . $organizer_url . '">' . $organizer_name .'</a>';
				endwhile;
                wp_reset_postdata();
			endif;
		else :
			$organizer_link = tribe_get_organizer_link( $organizer );
		endif;
	endif;

	?>
	<h4><span class="organizer-extended">Organizer<span class="sr-only">:</span> </span><?php echo $organizer_link; ?></h4>
	<?php

	if ( ! empty( $phone) || ! empty( $email ) || ! empty( $website ) )
	{
		?><dl><?php
		if ( ! empty( $phone ) )
		{
			?>
			<dt><i class="fas fa-fw fa-phone-square"></i> <?php esc_html_e( 'Phone', 'the-events-calendar' ) ?></dt>
			<dd><a href="tel:<?php echo esc_html( $phone ); ?>" title="Initiate telephone call to <?php echo $organizer_name; ?>"><?php echo esc_html( $phone ); ?></a></dd>
			<?php
		}

		if ( ! empty( $email ) )
		{
			?>
			<dt><i class="fas fa-fw fa-envelope"></i> <?php esc_html_e( 'Email', 'the-events-calendar' ) ?>
			</dt>
			<dd><a href="mailto:<?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a></dd>
			<?php
		}

		if ( ! empty( $website ) )
		{
			?>
			<dt><i class="fas fa-fw fa-external-link-alt"></i> <?php esc_html_e( 'Website', 'the-events-calendar' ) ?>
			</dt>
			<dd><a href="<?php echo $website; ?>" target="_blank"><?php echo $website_host; ?></a></dd>
			<?php
		}
        ?></dl><?php
	}
}
?>