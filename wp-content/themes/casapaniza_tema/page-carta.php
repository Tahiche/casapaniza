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

get_header();  
?>


		<div id="primary">
			<div id="content" role="main" class="pagecarta">



<?php //echo $post->post_name; ?>
<div id="cartas_pdf">
<?php   echo  get_all_added_attachment_icons();  ?> 
</div>

				<?php while ( have_posts() ) : the_post(); ?>
                
                
                
<?php //echo $post->post_name; ?>
					<?php 
					the_content();
					//get_template_part( 'content', $post->post_name ); ?>	 

					<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>