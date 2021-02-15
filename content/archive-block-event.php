<?php
/**
 * Template part for displaying a block event within archive-block_events
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
    <?php if ( has_post_thumbnail() ) : ?>
        <header class="item-header item-has-featured-image">
            <div class="item-header-image">
                <?php the_post_thumbnail(); ?>
            </div>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php else : ?>
    <header class="item-header">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>
            <section class="item-meta">
                <ul>
                    <li><i class="fas fa-fw fa-calendar-alt"></i><a href="<?php the_permalink(); ?>"><?php the_field( 'block_event_date' ); ?><?php if ( get_field( 'block_event_time' ) ) : ?> at <?php the_field( 'block_event_time' ); endif; ?></a></li>
                    <li><i class="fas fa-fw fa-map-marker-alt"></i><?php the_field( 'block_event_location' ); ?></li>
                </ul>
                <ul>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        </header>
        <section class="item-content">
            <?php the_content(); ?>
        </section>
        <footer class="item-footer">
            <?php 
            if ( get_primary_taxonomy_term( get_the_ID(), 'category' ) ) :
                $category = get_primary_taxonomy_term( get_the_ID(), 'category' );
            endif;
            ?>
            <p class="categories">Filed under <span class="collapse collapse-cat show" id="primaryCategory<?php echo get_the_ID(); ?>"><a href="<?php echo $category['url']; ?>"><?php echo $category['title']; ?></a>. <a href="#" data-toggle="collapse" data-target=".collapse" aria-expanded="true" aria-controls="primaryCategory allCategories">Show all categories</a>.</span> <span class="collapse collapse-cat" id="allCategories<?php echo get_the_ID(); ?>"><?php dutchtown_oxford_categories(); ?>.  <a href="#" data-toggle="collapse" data-target=".collapse" aria-expanded="false" aria-controls="primaryCategory<?php echo get_the_ID(); ?> allCategories<?php echo get_the_ID(); ?>">Show fewer categories</a>.</span></p>
            <p><?php dutchtown_footer_social_links(); ?>
            <?php if ( dutchtown_is_updated() ) : ?>
            This post was last updated on <?php dutchtown_updated_on(); ?>.
            <?php endif; ?></p>
        </footer>
    </div>
</article>