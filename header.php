<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and page header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="<?php echo autoversion( '/wp-content/themes/itaska/dist/css/main.min.css' ); ?>"> -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://www.google-analytics.com" crossorigin>
    <?php get_template_part( 'head/favicons' ); ?>	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="blog-<?php global $blog_id; echo $blog_id; ?>">
    <div class="site-wrapper">
        <a class="sr-only" href="#content"><?php esc_html_e( 'Skip to content.', 'dutchtown' ); ?></a>
        <?php get_template_part( 'nav/site-nav' ); ?>