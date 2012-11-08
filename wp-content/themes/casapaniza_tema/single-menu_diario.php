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
			<div id="content" role="main" class="menu_dia">
<div id="text_intro" class="textoclaro">
Casa Paniza les ofrece dos ambientes diferentes para degustar nuestros
menus diarios, menus concertados (para grupos), o bien nuestra carta
especializada con el mejor género de la cocina típica de Teruel.
</div>
<div id="flor">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
</div>
<div id="fecha_text">
<?php
$fecha = time();
echo FechaFormateada($fecha);
?>
</div>

			  <?php while ( have_posts() ) : the_post(); ?>
              <div id="menu_lista">
					<?php //get_template_part( 'content', $post->post_name ); 
					the_content();
					?>  
              </div>
				  <?php // comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
