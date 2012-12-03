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

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.cycle.lite.js"></script>
    
    <script>
$j=jQuery.noConflict();
 
 
// Use jQuery via $j(...)
jQuery(document).ready(function($){

// alert(jQuery('#imghome'));
    $('#imghome').cycle({
        delay: 2600,
        speed: 800
    });
    
});


    </script>
    
		<div id="primary"> 
			<div id="content-home" role="main">
<?php
	$Simage = array("s1","s2","s3","s4","s5","s6","s7","s8","s9");
	shuffle($Simage);
	$ar=implode(",",$Simage); 
	// print "XXX".$ar; 
	
?>


<div id="imghome" >
<!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_home.png" width="230" height="285" />-->
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slidehome/s0.png" style="position: absolute; top: 0px; z-index: 4; opacity: 0; display: none;"/>

<?php foreach ($Simage as $imge):  
 ?>
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/slidehome/<?php echo $imge ?>.jpg" /> 
 <?php endforeach; ?>
 
</div>
         </div>
		</div><!-- #primary -->

<?php get_footer(); ?>