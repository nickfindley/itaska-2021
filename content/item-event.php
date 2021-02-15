<?php
/**
 * The template part for an upcoming event listing on a page (DT2, DWNA, etc.)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
require get_template_directory() . '/functions/venue-link.php';

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';
$venue_address = tribe_get_address();
?>
<article class="item-event <?php tribe_events_event_classes(); ?>">
    <div class="item-container container">
        <?php if ( has_post_thumbnail() ) : ?>
        <header class="item-header item-has-featured-image">
            <div class="item-header-image">
                <?php the_post_thumbnail(); ?>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php else : ?>
        <header class="item-header">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php endif; ?>
            <section class="item-meta">
                <ul>
                    <?php
                    if ( tribe_is_recurring_event() ) :
                        $dates = tribe_get_recurrence_start_dates();
                        $current_date = date('Y-m-d H:i:s');
                        $found = false;

                        foreach ( $dates as $i => $d ) :
                            if ( ! $found && strcmp( $current_date, $d ) < 0 ) :
                                $found = true;
                                $date = date_create( $d );
                                $next_date = date_format( $date, 'F jS @ g:ia' );
                            endif;
                        endforeach;

                        echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-meta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . $next_date . '</a></li>';
                    else :
                        echo '<li><i class="fas fa-fw fa-clock"></i><span class="post-meta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . tribe_get_start_date() . '</a></li>';
                    endif;
                    if ( tribe_is_recurring_event() ) : ?>
                    <li><i class="fas fa-fw fa-calendar-alt"></i><span class="post-meta-expanded">Recurring: </span><a href="<?php echo tribe_all_occurences_link(); ?>">See all instances</a></li>
                    <?php endif;
                    if ( tribe_get_cost() ) : ?><li><i class="fas fa-fw fa-money-bill-alt"></i><?php echo tribe_get_cost( null, true ) ?></li><?php endif; ?>
                </ul>
                    <?php if ( $venue_link ) : ?><ul class="item-meta-location"><li><i class="fas fa-fw fa-map-marker-alt"></i><span class="post-meta-expanded">At </span><?php echo $venue_link; ?></li></ul><?php endif;
                    ?>
                <ul class="item-meta-share-links">
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        </header>
        <section class="item-content">
            <?php echo get_excerpt_by_id( get_the_ID() ); ?>
        </section>
    </div>
</article>