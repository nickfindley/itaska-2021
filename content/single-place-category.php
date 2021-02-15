<?php
/**
 * Template part for displaying a single place
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>
<article>
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
                <?php dutchtown_header_social_links(); ?>
            </ul>
        </section>
    </header>
    <section class="item-content">
        <?php if ( get_field( 'closed' ) ) : ?>
        <p class="place-closed">This place is reported as <strong>closed</strong>.</p>
        <?php endif; ?>
        <?php the_excerpt(); ?>
        <?php
            $website = get_field( 'website' );
            $telephone = dutchtown_format_phone( get_field( 'telephone' ) );
        ?>
        <?php if ( get_field( 'address' ) ) : ?>
        <p class="place-address"><?php echo get_field( 'address' ); ?><br>St. Louis, MO <?php echo get_field( 'zip_code' ); ?></p>
        <?php endif; ?>

        <?php if ( $telephone || $website ) : ?>
        <p>
            <?php if ( $telephone ) : ?>
                <a href="tel:<?php echo $telephone ; ?>" title="Dial <?php echo $telephone ; ?>"><?php echo $telephone ; ?></a>
            <?php endif; ?>
            <?php if ( $telephone && $website ) : ?>
                &nbsp;&bull;&nbsp;
            <?php endif; ?>
            <?php if ( $website ) : ?>
                <?php $website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST)); ?>
                <a href="<?php echo $website; ?>" target="_blank"><?php echo $website_host; ?></a></p>
            <?php endif; ?>
        </p>
        <?php endif; ?>

        <p><a href="<?php the_permalink(); ?>">More information about <?php the_title(); ?></a> <i class="fas fa-caret-right"></i></p>
    </section>
</article>