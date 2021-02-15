<?php
/**
 * Template part for displaying regular posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>

<article class="masonry-block">
    <div class="item-container container">
        <?php
            if ( has_post_thumbnail() ) :
        ?>
        <header class="item-header item-has-featured-image">
            <div class="item-header-image">
                <?php the_post_thumbnail(); ?>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php
            else :
        ?>
        <header class="item-header">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php
            endif;
        ?>
            <section class="item-meta">
                <ul>
                    <li><i class="fas fa-fw fa-file"></i><span class="post-meta-expanded">Posted on </span><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>
                    <?php dutchtown_icon_social_links(); ?>
                </ul>
            </section>
        </header>
        <section class="item-content">
        <?php
            if ( function_exists( 'ThreeWP_Broadcast' ) ) : 
                if ( broadcasted_from() ) : 
                    echo broadcasted_from();
                endif;
            endif;
            
            the_excerpt();
        ?>
        </section>
    </div>
</article>