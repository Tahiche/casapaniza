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
			<div id="content" role="main" class="menu_concertado">
<div id="flor">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
</div>

<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Anterior', 'twentyeleven' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Próximo <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
					</nav><!-- #nav-single -->
                    
                    
<h1>"Celebraciones y comidas de empresa"</h1>
<h2><?php //get_template_part( 'content', $post->post_name ); 
					the_title();
					?>  </h2>

			  <?php while ( have_posts() ) : the_post(); ?>
              <div id="menu_lista">
					<?php //get_template_part( 'content', $post->post_name ); 
					the_content();
					?>  
              </div>
				  <?php // comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

<div id="flor">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
