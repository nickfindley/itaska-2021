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
        <?php if ( get_current_blog_id() !== 1 ) : ?>
        <div class="search-result-from">
            <span>From <a href="<?php home_url(); ?>"><?php echo get_bloginfo( 'name' ); ?></a></span>
        </div>
        <?php endif; ?>
        
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
                    <?php if ( get_post_type( get_the_ID() ) == 'places' ) : ?>
                        <i class="fas fa-map-marker-alt"></i><a href="<?php the_permalink(); ?>">Dutchtown Places</a>
                    <?php elseif ( get_post_type( get_the_ID() ) == 'page' ) : ?>
                        <i class="fas fa-file-alt"></i><a href="<?php the_permalink(); ?>">Page</a>
                    <?php else : ?>
                        <?php
                        if ( function_exists( 'tribe_is_event' ) ) : 
                            if ( tribe_is_event() ) :  ?>
                            <i class="far fa-fw fa-calendar-alt"></i>
                            <?php else : ?>
                            <i class="fas fa-fw fa-file"></i>
                            <?php endif;
                        endif;
                        dutchtown_posted_on();
                    endif; ?></li>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        </header>

        <section class="item-content">
            <?php relevanssi_the_excerpt(); ?>
            <p><a href="<?php the_permalink(); ?>">Read more of <b><?php the_title(); ?></b> <i class="fas fa-caret-right"></i></a></p>
        </section>
    </div>
</article>