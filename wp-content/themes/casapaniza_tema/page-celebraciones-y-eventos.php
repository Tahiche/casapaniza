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
           <?php   echo  get_all_added_attachment_icons();  ?>
<div id="flor">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flor_decor.png" width="35" height="30" alt="Flor Casapaniza" />
</div>

<div id="text_intro" class="textoclaro">
<?php  the_post();             
	   the_content();
	   
?>                
</div>

<h2>
"Celebraciones y comidas de empresa"
</h2>

			 
              <div id="menu_lista">
					<?php //get_template_part( 'content', $post->post_name ); 
					$args = array(
              'post_type' => 'menu_concertado',
			  'showposts'=>10
			  );
					$posts = get_posts($args);
					//d($posts);
foreach ($posts as $post)
    {
		//d($post);
		
          echo "<span class='boldermenu'>".$post->post_title."</span>  (<a href='".get_permalink()."'>ver menú</a>)<br>";  
    }
					?>  
              </div>


			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
