<?php
/**
 * Template part for displaying posts on archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>

<article>
    <div class="item-container container">
        <div class="search-result-from">
            <span>From the <a href="/calendar/">Dutchtown Calendar</a></span>
        </div>
        
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
                    <li>
                        <i class="fas fa-fw fa-calendar-alt"></i> <?php dutchtown_posted_on(); ?>
                    </li>
                <?php
                    if ( tribe_is_recurring_event() ) :
                ?>
                    <li>
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span class="post-meta-expanded">Recurring: </span>
                        <a href="<?php echo tribe_all_occurences_link(); ?>">See all dates and times</a>
                    </li>
                <?php
                    endif;
                    dutchtown_header_social_links();
                ?>
                </ul>
            </section>
        </header>

        <section class="item-content">
            <?php relevanssi_the_excerpt(); ?>
            <p><a href="<?php the_permalink(); ?>">Learn more about <b><?php the_title(); ?></b> <i class="fas fa-caret-right"></i></a></p>
        </section>
    </div>
</article>