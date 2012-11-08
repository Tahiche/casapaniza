<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary"> 
			<div id="content-home" role="main">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_home.png" width="230" height="285" />
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>