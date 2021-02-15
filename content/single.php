<?php
/**
 * Template part for displaying a single regular post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
<header class="main-header main-has-featured-image">
    <div class="main-header-img-container container">
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
                <li><i class="fas fa-fw fa-file"></i><span class="post-meta-expanded">Posted on </span><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></li>
                <?php dutchtown_header_social_links(); ?>
            </ul>
            <ul class="post-comment-links">
            <?php
            dutchtown_comment_link( array(
                'before_list'	=> '<li><i class="fas fa-fw fa-comments"></i>',
                'after_list'	=> '</li> ',
                'before_form'	=> '<li><i class="fas fa-fw fa-comment-alt"></i>',
                'after_form'	=> '</li>',
                'count_args'	=> array(
                    'cap'		=> true,
                    'there'		=> false,
                    'show_zxero' => true
                    )
                )
            );
            ?>
            </ul>
        </section>
    </div>
</header>
<section class="main-content">
    <div class="main-content-container container">
        <?php the_content(); ?>
    </div>
</section>
<div class="main-footer-container container">
    <footer class="main-footer">        
        <?php $category = get_primary_taxonomy_term(); ?>
        <p class="categories">Filed under <span class="collapse collapse-cat show" id="primaryCategory<?php echo get_the_ID(); ?>"><a href="<?php echo $category['url']; ?>"><?php echo $category['title']; ?></a>. <a href="#" data-toggle="collapse" data-target=".collapse" aria-expanded="true" aria-controls="primaryCategory allCategories">Show all categories</a>.</span> <span class="collapse collapse-cat" id="allCategories<?php echo get_the_ID(); ?>"><?php dutchtown_oxford_categories(); ?>.  <a href="#" data-toggle="collapse" data-target=".collapse" aria-expanded="false" aria-controls="primaryCategory<?php echo get_the_ID(); ?> allCategories<?php echo get_the_ID(); ?>">Show fewer categories</a>.</span></p>
        <p><?php dutchtown_footer_social_links(); ?>
        <?php if ( dutchtown_is_updated() ) : ?>
        This post was last updated on <?php dutchtown_updated_on(); ?>.
        <?php endif; ?></p>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
    </footer>
</div>