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
<?php edit_post_link("Editar menú"); ?> 
<div id="primary">
			<div id="content" role="main" class="menu_dia">
<div id="text_intro" class="textoclaro">
Casa Paniza les ofrece dos ambientes diferentes para degustar nuestros
menus diarios, <a href="/celebraciones-y-eventos/" class="link_oblique">menus concertados</a> (para grupos), o bien nuestra <a href="/carta/" class="link_oblique">carta</a>
especializada con el mejor género de la cocina típica de Teruel.
</div>
<div id="flor">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
</div>
<div id="fecha_text">
<?php
$fecha = time();
//echo FechaFormateada($fecha);
//$slug = basename(get_permalink());
?>
</div>

			  <?php while ( have_posts() ) : the_post(); ?>
              <div id="menu_lista">
              <h2><?php the_title(); ?></h2>
					<?php //get_template_part( 'content', $post->post_name ); 
					the_content();
					?>  
              </div>
				  <?php // comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
