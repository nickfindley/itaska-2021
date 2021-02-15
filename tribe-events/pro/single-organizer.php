<?php
/**
 * Single Organizer Template
 * The template for an organizer. By default it displays organizer information and lists
 * events that occur with the specified organizer.
 *
 * This view contains the filters required to create an effective single organizer view.
 *
 * @package TribeEventsCalendarPro
 *
 * @version 4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
die( '-1' );
}

$organizer_id = get_the_ID();
?>

<?php while ( have_posts() ) : the_post(); ?>
<main class="main-events">
	<header class="main-header">
		<div class="main-header-container container">
			<h1 class="tribe-events-page-title"><span>Organizer </span><?php the_title() ?></h1>
		</div>
	</header>
    <section class="main-content">
        <div class="main-content-container container">
            <?php tribe_the_notices() ?>
            <?php the_content(); ?>
            <h3>Organizer Information</h3>
            <?php
            $telephone    = tribe_get_organizer_phone();
            $website_link = tribe_get_organizer_website_link();

            if ( $website_link ) :
                $website = tribe_get_organizer_website_url();
                $website_parse = parse_url( $website );
                $website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST));
            endif;

            if ( $telephone || $website_link ) : ?>
            <dl class="organizer-info">
                <?php if ( $website_link ) : ?>
                <dt><i class="fas fa-fw fa-external-link-square-alt"></i> Website</dt>
                <dd><a href="<?php echo $website; ?>"><?php echo $website_host; ?></a></dd>
                <?php endif; ?>
                <?php if ( $telephone ) : ?>
                <dt><i class="fas fa-fw fa-phone-square-alt"></i> Telephone</dt>
                <dd><?php echo $telephone; ?></dd>
                <?php endif; ?>
            </dl>
            <?php endif; ?>
        </div>
    </section>

    <?php
    $upcoming_events = new WP_Query( array(
        'post_type' => array(TribeEvents::POSTTYPE),
        'eventDisplay' => 'upcoming',
        'posts_per_page' => -1,
        'meta_key' => '_EventStartDate',
        'orderby' => '_EventStartDate',
        'order' => 'ASC',
        'tribeHideRecurrence' => true,
        'organizer' => $organizer_id
    ));

    if ( $upcoming_events->have_posts() )
    {
        ?>
        <section class="upcoming-events">
            <header class="upcoming-events-header container">
                <h2>Upcoming Events</h2>
            </header>
        <?php
        while ( $upcoming_events->have_posts() )
        {
            $upcoming_events->the_post();
            get_template_part( 'content/single-place-event' );
        }
        wp_reset_postdata();
        ?>
        </section>
        <?php
    }
    else{
        ?>
        <section class="upcoming-events">
           <div class="tribe-events-notices container">
                <p>This organizer doesn&apos;t have any events currently scheduled.</p>
            </div>
        </section>
        <?php
    }
    ?>
</main>
<?php endwhile; ?>