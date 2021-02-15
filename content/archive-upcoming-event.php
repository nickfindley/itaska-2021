<?php
/**
 * Template part for displaying upcoming events on archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

require get_template_directory() . '/functions/venue-link.php';
?>
<article>
    <div class="item-container container">
        <header class="item-header">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <section class="item-meta">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="far fa-fw fa-calendar-alt"></i></span><?php dutchtown_posted_on(); ?></li>
                    <li><span class="fa-li"><i class="fas fa-fw fa-map-marker-alt"></i></span><span class="post-meta-expanded">At </span><?php echo $venue_link; ?></li>
                    <?php if ( tribe_is_recurring_event() ) : ?><li><span class="fa-li"><i class="fas fa-fw fa-list"></i></span><span class="post-meta-expanded">Recurring: </span><a href="<?php echo tribe_all_occurences_link(); ?>">See all instances</a></li><?php endif; ?>
                </ul>
            </section>
        </header>
        <?php echo get_excerpt_by_id( get_the_ID() ); ?>
    </div>
</article>