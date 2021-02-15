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
        <header class="item-header">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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

                        echo '<li><i class="fas fa-fw fa-calendar-alt"></i><span class="post-meta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . $next_date . '</a></li>';
                    else :
                        echo '<li><i class="fas fa-fw fa-calendar-alt"></i><span class="post-meta-expanded">Event on </span><a href="' . tribe_get_event_link() . '">' . tribe_get_start_date() . '</a></li>';
                    endif;
                    ?>
                </ul>
            </section>
        </header>
        <section class="item-content">
            <p><a href="<?php the_permalink(); ?>">More info on <b><?php the_title(); ?></b></a> <i class="fas fa-caret-right"></i></p>
        </section>
    </div>
</article>