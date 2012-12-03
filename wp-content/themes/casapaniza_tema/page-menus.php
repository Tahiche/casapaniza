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
			<div id="content" role="main" class="p_menus">
 


<div id="text_intro" class="textoclaro">
Casa Paniza les ofrece dos ambientes diferentes para degustar nuestros
menus diarios, <a href="/celebraciones-y-eventos/" class="link_oblique">menus concertados</a> (para grupos), o bien nuestra <a href="/carta/" class="link_oblique">carta</a>
especializada con el mejor género de la cocina típica de Teruel.
</div>

<div id="lista_menus">
        <div id="flor">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
        </div>
        
        <h2><a href="/menu_diario/menu-del-dia/">Menú del Día</a></h2>
        <h2><a href="/menu_diario/menu-del-domingo/">Menú del Domingo</a></h2>
        <h2><a href="/menu_diario/menu-de-festivos/">Menú de Festivos</a></h2>
        
        <div id="flor">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
        </div>
</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>