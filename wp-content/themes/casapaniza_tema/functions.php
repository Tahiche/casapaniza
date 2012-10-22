<?php
define('DIR_JS', get_stylesheet_directory_uri() . '/js');
define('PARENT_JS', get_template_directory_uri() . '/js');
// load menu alter for editor
require_once(STYLESHEETPATH .'/funciones/menu_alter.php');

if(!is_admin()) {
	//wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js' );
	//quito el js de pictureThis y añado el mio (picturethis en framework/scripts, es un include
	wp_deregister_script('custom', PARENT_JS . '/custom.js');
	// el ultimo array es la dependencia, ya que jquery tiene que ir antes
	wp_enqueue_script('custom_monstruo', DIR_JS . '/monstruo.js',  array('jquery') );
}

/************************************************* added **************************************************/
if ( function_exists( 'add_theme_support' ) ) {
	//echo "add_theme_supportadd_theme_supportadd_theme_supportadd_theme_supportadd_theme_support";
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 510, 300, true );
}
//echo "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX add_post_type_supportXXXX";
add_post_type_support('page', 'excerpt');
add_post_type_support('portfoliocpt', 'excerpt');

// this can live in /themes/mytheme/functions.php, or maybe as a dev plugin?
function get_template_name () {
	foreach ( debug_backtrace() as $called_file ) {
		foreach ( $called_file as $index ) {
			if ( !is_array($index[0]) AND strstr($index[0],'/themes/') AND !strstr($index[0],'footer.php') ) {
				$template_file = $index[0] ;
			}
		}
	}
	$template_contents = file_get_contents($template_file) ;
	preg_match_all("(Template Name:(.*)\n)siU",$template_contents,$template_name);
	$template_name = trim($template_name[1][0]);
	if ( !$template_name ) { $template_name = '(default)' ; }
	$template_file = array_pop(explode('/themes/', basename($template_file)));
	return $template_file . ' > '. $template_name ;
}


// Add the ability to use post thumbnails if it isn't already enabled.
// Not required. Use only of you want to have more than the large,
// medium or thumbnail options WP uses by default.

if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );

// Add custom thumbnail sizes to your theme. These sizes will be auto-generated
// by the media manager when adding images to it on a new post.
if ( function_exists( 'add_image_size' ) ) {
	/*add_image_size( 't500crop', 500, 320, true );
	add_image_size( 't500fit', 500, 320 );
	add_image_size( 'w510', 510, 1700, true );*/
	/*add_image_size( 't2x1', 307, 200, true );
	add_image_size( 't2x2', 307, 417, true );*/
}

///////////////////////////////////////////////
//
// Start WPOutfitters.com Custom Galley Function
//
//////////////////////////////////////////////

function wpo_get_images($size = 'thumbnail', $limit = '0', $offset = '0', $big = 'large', $post_id = '$post->ID', $link = '1', $img_class = 'attachment-image', $wrapper = 'div', $wrapper_class = 'attachment-image-wrapper') {
	global $post;

	$images = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($images) {

		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;

		$i = 0;
		foreach ($images as $attachment_id => $image) {
			if ($start <= $i and $i < $stop) {
			$img_title = $image->post_title;   // title.
			$img_description = $image->post_content; // description.
			$img_caption = $image->post_excerpt; // caption.
			//$img_page = get_permalink($image->ID); // The link to the attachment page.
			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			if ($img_alt == '') {
			$img_alt = $img_title;
			}
				if ($big == 'large') {
				$big_array = image_downsize( $image->ID, $big );
 				$img_url = $big_array[0]; // large.
				} else {
				$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
				}
			//echo "XXX".startsWithNumber($size );
			// FIXED to account for non-existant thumb sizes.
			$preview_array = image_downsize( $image->ID, $size );
			//d($preview_array );
			if ($preview_array[3] != 'true') {
			$preview_array = image_downsize( $image->ID, 'thumbnail' );
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
			} else {
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
 			}
 			// End FIXED to account for non-existant thumb sizes.

 			///////////////////////////////////////////////////////////
			// This is where you'd create your custom image/link/whatever tag using the variables above.
			// This is an example of a basic image tag using this method.
			?>
			<?php if ($wrapper != '0') : ?>
			<<?php echo $wrapper; ?> class="<?php echo $wrapper_class; ?>">
			<?php endif; ?>
			<?php if ($link == '1') : ?>
			<a href="<?php echo $img_url; ?>" title="<?php echo $img_title; ?>">
			<?php endif; ?>
			<img class="<?php echo $img_class; ?>" src="<?php echo $img_preview; ?>" alt="<?php echo $img_alt; ?>" title="<?php echo $img_title; ?>" />
			<?php if ($link == '1') : ?>
			</a>
			<?php endif; ?>
			<?php if ($img_caption != '') : ?>
			<div class="attachment-caption"><?php echo $img_caption; ?></div>
			<?php endif; ?>
			<?php if ($img_description != '') : ?>
			<div class="attachment-description"><?php echo $img_description; ?></div>
			<?php endif; ?>
			<?php if ($wrapper != '0') : ?>
			</<?php echo $wrapper; ?>>
			<?php endif; ?>
			<?
			// End custom image tag. Do not edit below here.
			///////////////////////////////////////////////////////////

			}
			$i++;
		}

	}
} 

///////////////////////////////////////////////
//
// End WPOutfitters.com WP Custom Galley Function
//
//////////////////////////////////////////////
/*******************************************
Explanation of the arguments passed to the function:

wpo_get_images(
[preview_size], // See note 1
[number_of_images_to_show], // See note 2
[offset_from_first_image], // See note 3
[big_image_size], // See note 4
[post_id_to_get_images_from], // See note 5
[link_to_large_image], // See note 6
[image_class], // See note 7
[html_wrapper_tag], // See note 8
[html_wrapper_class] // See note 9
);

Notes:

1. The size of the WP produced thumbnail you want displayed. WP gives you 4 choices by default: 'thumbnail', 'medium', 'large', or 'full'. Using the add_image_size function in your functions.php file you can add your own sizes. This function defaults to 'thumbnail'.

2. Max number of images you want displayed for this call to the function. It will max out at the total number of images attached to the post. Defaults to showing all images.

3. Lets you start at image 2, 3, etc. Useful for distributing images around your post. The number here can override the numb roof images to show. Example: Say your post has 10 attached images. If you set this to 6 the function will only return images number 7,8,9,10 (4 total images) since you told the function to start at image number 6. This is simply because you've run out of images to print before you reach the number you requested.

4. The size of the large image you want to link to. Can either be 'large' or 'full'. Setting it to large will link to an image that WP resizes in accordance to what you set your large image size to on the media settings page. Setting it to 'full' will link to the untouched image you uploaded.

5. The post ID you want to show images from. Useful if you want to grab images form another post or want to set up a portfolio type thing. Defaults to the current post's ID ("$post->ID"). Remember to use double quotes when setting this one!

6. Whether or not to link to a large image. 0 = no, 1 = yes. If set to no, it will just display your chosen images set in [preview_size] without linking to bigger ones.

7. Name of the css class added to the image tag. Defaults to 'attachment-image'.

8. Type of html wrapper to enclose each image and all of it's related code in. Defaults to 'div'. Can also be 'ul', 'p', 'span', etc.

9. The css class assigned to each [html_wrapper_tag]. Defaults to 'attachment-image-wrapper'.

More notes: 

- In the media manager you can set the image's alt and title for each image. 

- If you choose to set a caption for an image, it will be displayed below the image and wrapped in a div called "attachment-caption".

- If you choose to set a description for an image, it will be displayed below the image and caption and wrapped in a div called "attachment-description".

*******************************************/

function wpo_monstruo_get_images($w=800, $h=656, $limit = '0', $offset = '0', $big = 'large', $post_id = '$post->ID', $link = '1', $img_class = 'attachment-image', $wrapper = 'div', $wrapper_class = 'attachment-image-wrapper') {
	global $post;

	$images = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($images) {

		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;

		$i = 0;
		foreach ($images as $attachment_id => $image) {
			if ($start <= $i and $i < $stop) {
			$img_title = $image->post_title;   // title.
			$img_description = $image->post_content; // description.
			$img_caption = $image->post_excerpt; // caption.
			//$img_page = get_permalink($image->ID); // The link to the attachment page.
			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			if ($img_alt == '') {
			$img_alt = $img_title;
			}
				/*if ($big == 'large') {
				$big_array = image_downsize( $image->ID, $big );
 				$img_url = $big_array[0]; // large.
				} else {
				$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
				}
			//echo "XXX".startsWithNumber($size );
			// FIXED to account for non-existant thumb sizes.
			$preview_array = image_downsize( $image->ID, $size );
			//d($preview_array );
			if ($preview_array[3] != 'true') {
			$preview_array = image_downsize( $image->ID, 'thumbnail' );
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
			} else {
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
 			}*/
			echo "wpo_monstruo_get_imageswpo_monstruo_get_imageswpo_monstruo_get_imageswpo_monstruo_get_imageswpo_monstruo_get_images";
			$image_p = vt_resize( $image->ID,'' , 253, 145, true, 70 ); 
			d($image_p);
 			// End FIXED to account for non-existant thumb sizes.

 			///////////////////////////////////////////////////////////
			// This is where you'd create your custom image/link/whatever tag using the variables above.
			// This is an example of a basic image tag using this method.
			?>
            
            <?php echo '<img src="'.$image_p[url].'" width="'.$image_p[width].'" height="'.$image_p[height].'" alt="'.$lbtitle.'" class="front" /></a>'; ?>
            
			<?php if ($wrapper != '0') : ?>
			<<?php echo $wrapper; ?> class="<?php echo $wrapper_class; ?>">
			<?php endif; ?>
			<?php if ($link == '1') : ?>
			<a href="<?php echo $img_url; ?>" title="<?php echo $img_title; ?>">
			<?php endif; ?>
			<img class="<?php echo $img_class; ?>" src="<?php echo $img_preview; ?>" alt="<?php echo $img_alt; ?>" title="<?php echo $img_title; ?>" />
			<?php if ($link == '1') : ?>
			</a>
			<?php endif; ?>
			<?php if ($img_caption != '') : ?>
			<div class="attachment-caption"><?php echo $img_caption; ?></div>
			<?php endif; ?>
			<?php if ($img_description != '') : ?>
			<div class="attachment-description"><?php echo $img_description; ?></div>
			<?php endif; ?>
			<?php if ($wrapper != '0') : ?>
			</<?php echo $wrapper; ?>>
			<?php endif; ?>
			<?
			// End custom image tag. Do not edit below here.
			///////////////////////////////////////////////////////////

			}
			$i++;
		}

	}
} 




function startsWithNumber($string) {
    return preg_match('/^\d/', $string) === 1;
}


?>