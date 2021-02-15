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
                    <li><i class="fas fa-fw fa-file"></i><span class="post-meta-expanded">Posted on </span><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>
                    <?php dutchtown_header_social_links(); ?>
                </ul>
                <?php if ( comments_open() || get_comments_number() > 0 ) : ?>
                <ul class="post-comment-links">
                <?php
                dutchtown_comment_link( array(
                    'before_list'	=> '<li><i class="fas fa-fw fa-comments"></i>',
                    'after_list'	=> '</li> ',
                    'before_form'	=> '<li><i class="fas fa-fw fa-comment-alt"></i>',
                    'after_form'	=> '</li>',
                    'count_args'	=> array(
                        'cap'		=> true,
                        'there'		=> false
                        )
                    )
                );
                ?>
                </ul>
                <?php endif; ?>
            </section>
        </header>
        <section class="item-content">
            <?php if ( function_exists( 'ThreeWP_Broadcast' ) ) : if ( broadcasted_from() ) : echo broadcasted_from(); endif; endif; ?>
            <?php the_content(); ?>
        </section>
        <footer class="item-footer">
            <?php $category = get_primary_taxonomy_term(); ?>
            <p class="categories">Filed under <span class="collapse collapse-cat show" id="primaryCategory<?php echo get_the_ID(); ?>"><a href="<?php echo $category['url']; ?>"><?php echo $category['title']; ?></a>. <a href="#" data-toggle="collapse" data-target=".collapse-cat" aria-expanded="true" aria-controls="primaryCategory allCategories">Show all categories</a>.</span> <span class="collapse collapse-cat" id="allCategories<?php echo get_the_ID(); ?>"><?php dutchtown_oxford_categories(); ?>.  <a href="#" data-toggle="collapse" data-target=".collapse-cat" aria-expanded="false" aria-controls="primaryCategory<?php echo get_the_ID(); ?> allCategories<?php echo get_the_ID(); ?>">Show fewer categories</a>.</span></p>
            <p><?php dutchtown_footer_social_links(); ?>
            <?php if ( dutchtown_is_updated() ) : ?>
            This post was last updated on <?php dutchtown_updated_on(); ?>.
            <?php endif; ?></p>
        </footer>
    </div>
</article>