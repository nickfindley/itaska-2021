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
                        <i class="fas fa-map-marker-alt"></i><a href="<?php the_permalink(); ?>">Dutchtown Places</a>
                    </li>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
            </section>
        </header>

        <section class="item-content">
            <?php if ( get_field( 'closed' ) ) : ?>
            <p class="place-closed">This place is reported as <strong>closed</strong>.</p>
            <?php endif; ?>
            
            <?php 
                $date = strtotime( get_field( 'new_in_town' ) );
                $today = strtotime( date( 'Y-m-d' ) );
                if ( $date != null && $date > $today ) :
            ?>
            <p class="new-in-town"><?php the_title(); ?> is <strong>new</strong> to Dutchtown!</p>
            <?php endif; ?>
            
            <dl class="place-contact">
            <?php
                $website = get_field( 'website' );
                $telephone = dutchtown_format_phone( get_field( 'telephone' ) );

                if ( get_field( 'address' ) ) :
            ?>
                <dt>Address</dt>
                <dd>
                    <?php echo get_field( 'address' ); ?><br>
                    St. Louis, MO <?php echo get_field( 'zip_code' ); ?>
                </dd>
            <?php
                endif;
                if ( $telephone ) :
            ?>
                <dt>Telephone</dt>
                <dd>
                    <a href="tel:<?php echo $telephone; ?>" title="Dial <?php echo $telephone; ?>">
                        <?php echo $telephone; ?>
                    </a>
                </dd>
            <?php
                endif;
                if ( $website ) :
                    $website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST));
            ?>
                <dt>Website</dt>
                <dd>
                    <a href="<?php echo $website; ?>" target="_blank">
                        <?php echo $website_host; ?>
                    </a>
                </dd>
            <?php
                endif
            ?>
            </dl>
            <p>
                <a href="<?php the_permalink(); ?>">
                    Find out more about <b><?php the_title(); ?></b> <i class="fas fa-caret-right"></i>
                </a>
            </p>
        </section>
    </div>
</article>