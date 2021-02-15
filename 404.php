<?php
/**
 * The template for a 404 page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

get_header(); ?>
<main class="main-error" id="content">
    <header class="main-header">
		<div class="main-header-container container">
			<h1><span>404 Error </span>Page Not Found</h1>
		</div>
    </header>
    <article>
        <section class="main-content">
            <div class="main-content-container container">
                <p>Sorry, it looks like the page you requested can't be located. Please try searching below. You can also <a href="/contact/">contact us</a> if you&apos;re still having trouble.</p>
                <h3>Search DutchtownSTL.org</h3>
                <?php echo get_search_form(); ?>
                <div class="error-links">
                    <section class="error-categories">
                        <h4>Posts by Category</h4>
                        <ul class="list-unstyled">
                        <?php 
                            $args = array(
                                'exclude' => '1',
                                'title_li' => '',
                                'show_count' => false
                            );
                            wp_list_categories( $args );
                        ?>
                        </ul>
                    </section>
                    <section class="error-archives">
                        <h4>Posts by Date</h4>
                        <ul class="list-unstyled">
                        <?php 
                            $args = array(
                                'type' => 'monthly'
                            );
                            wp_get_archives( $args );
                        ?>
                        </ul>
                    </section>
                    <section class="error-tags">
                        <h4>Posts by Tag</h4>
                        <?php
                            $args = array(
                                'smallest' => .75,
                                'largest' => 1.5,
                                'unit' => 'rem',
                                'exclude' => '18, 29, 243, 299, 404, 411, 502, 534, 623, 1063, 1064, 1148, 1305, 1745, 3285'
                            );
                            wp_tag_cloud( $args );
                        ?>
                    </section>
                </div>
            </div>
        </section>
    </article>
    <div class="main-footer-container container">
        <footer class="main-footer">
            <?php if ( function_exists('yoast_breadcrumb') ) : ?><p class="post-breadcrumbs"><?php yoast_breadcrumb(); ?></p><?php elseif ( function_exists( 'bcn_display' ) ) : ?><p class="post-breadcrumbs"><?php bcn_display(); ?></p><?php endif;?>
        </footer>
    </div>
</main>
<?php get_footer(); ?>