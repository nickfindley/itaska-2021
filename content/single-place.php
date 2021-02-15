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
<?php if ( has_post_thumbnail() ) : ?>
<header class="main-header main-has-featured-image">
    <div class="main-header-image-container container">
        <div class="main-header-image">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php else : ?>
<header class="main-header">
    <div class="main-header-container container">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php endif; ?>
        <section class="main-meta">
            <ul>
                <?php dutchtown_header_social_links(); ?>
            </ul>
        </section>
    </div>
</header>
<?php 
$start_date = date( 'Y-m-d', strtotime( '2019-11-29' ) );
$end_date = date( 'Y-m-d', strtotime( '2019-12-31' ) );
$today = date ( 'Y-m-d' );
$today = date( 'Y-m-d', strtotime( $today ) );
if (
    get_field( 'dutchtown_cid' ) || 
    get_field( 'cherokee_street' ) ||
    ( get_field( 'dutchtown_passport' )  && ( $today >= $start_date ) && ( $today <= $end_date ) ) ||
    get_field( 'minority_owned' )
) :
?>
<div class="place-banner">
    <div class="place-banner-container">
        <?php if ( get_field( 'dutchtown_cid' ) ) : ?>
        <p><i class="fas fa-fw fa-city"></i> Located in the <a href="https://www.dutchtownstl.org/cid/">Dutchtown CID</a></p>
        <?php endif; ?>
        <?php if ( get_field( 'cherokee_street' ) ) : ?>
        <p><i class="fas fa-fw fa-sun"></i> In the <a href="https://cherokeestreet.com/">Cherokee Street</a> Business District</p>
        <?php endif; ?>
        <?php if ( get_field( 'dutchtown_passport' ) ) : if ( $today >= $start_date && $today <= $end_date ) : ?>
        <p><i class="fas fa-fw fa-passport"></i> Participating <a href="/passport/">Dutchtown Passport</a> location</p>
        <?php endif; endif; ?>
        <?php
            if ( get_field( 'minority_owned' ) ) :
                if (
                    get_field( 'black_owned' ) ||
                    get_field( 'woman_owned' ) ||
                    get_field( 'latino_owned' )
                ) :
                    if ( get_field( 'black_owned' ) ) :
        ?>
        <p><i class="fas fa-fw fa-globe-africa"></i> Black Owned Business</p>
        <?php
                    endif;
                    if ( get_field( 'woman_owned' ) ) :
        ?>
        <p><i class="fas fa-fw fa-venus"></i> Woman Owned Business</p>
        <?php
                    endif;
                    if ( get_field( 'latino_owned' ) ) :
        ?>
        <p><i class="fas fa-fw fa-globe-americas"></i> Latino Owned Business</p>
        <?php 
                    endif;
                else : 
        ?>
        <p><i class="fas fa-fw fa-user"></i> Minority Owned Business</p>
        <?php
                endif;
            endif;
        ?>
    </div>
</div>
<?php endif; ?>
<section class="main-content">
    <div class="main-content-container container">
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
        <?php the_content(); ?>
        <?php
            $website = get_field( 'website' );
            $telephone = dutchtown_format_phone( get_field( 'telephone' ) );
            $email = get_field( 'email' );
        ?>
        <h3>Contact</h3>
        <dl class="place-contact">
            <?php if ( get_field( 'address' ) ) : ?>
            <dt>Address</dt>
            <dd><?php echo get_field( 'address' ); ?><br>St. Louis, MO <?php echo get_field( 'zip_code' ); ?></dd>
            <?php endif; ?>

            <?php if ( $telephone ) : ?>
            <dt>Telephone</dt>
            <dd><a href="tel:<?php echo $telephone; ?>" title="Dial <?php echo $telephone; ?>"><?php echo $telephone; ?></a></dd>
            <?php endif; ?>

            <?php if ( $website ) : ?>
            <?php $website_host = str_ireplace('www.', '', parse_url($website, PHP_URL_HOST)); ?>
            <dt>Website</dt>
            <dd><a href="<?php echo $website; ?>" target="_blank"><?php echo $website_host; ?></a></dd>
            <?php endif; ?>

            <?php if ( $email ) : ?>
            <dt>Email</dt>
            <dd><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></dd>
            <?php endif; ?>
        </dl>
        <?php
        if ( get_field( '24_7' ) ) :
        ?>
        <h3>Hours</h3>
        <p>Open 24 hours, seven days a week.</p>
        <?php
        elseif ( have_rows( 'daily_hours' ) ) :
        ?>
        <h3>Hours</h3>
        <dl class="place-hours">
        <?php
            while ( have_rows( 'daily_hours' ) ) :
                the_row();
        ?>
            <dt><?php the_sub_field( 'day' ); ?></dt>
            <dd><?php the_sub_field( 'hours' ); ?></dd>
        <?php
            endwhile;
        ?>
        </dl>
        <?php
        elseif ( get_field( 'hours' ) ) :
            $hours = preg_split('/\r\n|\r|\n|: /', get_field( 'hours' ));
        ?>
        <h3>Hours</h3>
        <dl class="place-hours">
            <?php
            foreach ( $hours as $hour ) :
                if ( preg_match( '/day/', $hour ) ) :
                    if ( preg_match( '/24 hours/', $hour ) ) : ?>
                        <dt class="twenty-four-hours"><?php echo $hour; ?></dt>
                    <?php else : ?>
                        <dt><?php echo $hour; ?></dt>
                    <?php endif; ?>
                <?php else : ?>
                        <dd><?php echo $hour; ?></dd>
                <?php endif; ?>
            <?php endforeach; ?>
        </dl>
        <?php
        endif;
        if ( get_field( 'address' ) ) :
        ?>
        <div class="place-map">
            <?php
                $wp_address = get_field( 'address' ) . ', ' . 'St. Louis, MO ' . get_field( 'zip_code' ); 
                $shortcode = '[map addr="' . $wp_address . '"]';
                $shortcode .= get_the_title() . ', ';
                $shortcode .= get_field( 'address' );
                $shortcode .= '[/map]';
                echo do_shortcode( $shortcode )
            ?>
        </div>
        <?php
            endif;
        ?>
    </div>
</section>