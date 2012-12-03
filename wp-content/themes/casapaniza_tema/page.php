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

$pageName=$wp_query->post->post_name
?>

		<div id="primary">
			<div id="content" role="main" class="content-<?php echo $pageName ?>">



<?php 

if($pageName=="otros-servicios" ||  $pageName=="contacto"):?>
<div id="flor">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
</div>
<?php endif; ?>

<?php 

if($pageName=="galeria-de-imagenes"):?>
<div id="links_panoramica">
<a href="#">Ver panorámica Salon 1</a>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor_peq.png" width="18" height="15" alt="Flor Casapaniza" />
<a href="#">Ver panorámica Salon 2</a>
</div>
<?php endif; ?>


<?php   echo  get_all_added_attachment_icons();  ?> 

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