<?php
/*
Plugin Name: Easy Add Thumbnail Modded for attachments by Tahi
Plugin URI: http://wordpress.org/extend/plugins/easy-add-thumbnail/
Description: Checks if you defined the post thumbnail, and if not it sets the thumbnail to the first uploaded image for that post. So easy like that...
Author: Samuel Aguilera
Version: 1.0.1
Author URI: http://www.samuelaguilera.com
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License version 3 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( function_exists( 'add_theme_support' ) ) {

add_theme_support( 'post-thumbnails' );
      
 function easy_add_thumbnail_modded() {
      
   global $post;
          
   $already_has_thumb = has_post_thumbnail();
  // d( $already_has_thumb);      
  if (!$already_has_thumb)  {
  if( function_exists( 'attachments_get_attachments' ) )
  {
    $attachments = attachments_get_attachments();
	//d($attachments);
    $total_attachments = count( $attachments );
	//d($attachments[0]);
	//d($attachments[0]['id']);
	//echo "<h1>XXX".$attachments[0]['id']."</h1>";
	add_post_meta($post->ID, '_thumbnail_id', $attachments[0]['id'], true);  
									
	/*$attached_image =$attachments;
	if ($attached_image) {
                      	
                                foreach ($attached_image as $attachment_id => $attachment) {   
								d($attachment_id);                         	
                                add_post_meta($post->ID, '_thumbnail_id', 103, true);                                 
                                }     
                        
                           }*/
  }
  
/* $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
d($attached_image);
                          if ($attached_image) {
                      	
                                foreach ($attached_image as $attachment_id => $attachment) {                            	
                                add_post_meta($post->ID, '_thumbnail_id', $attachment_id, true);                                 d($attachment_id);
                                }     
                        
                           }*/
                         
                        }
						 //add_post_meta($post->ID, '_thumbnail_id', 103, true);
      } // fin función

  add_action('the_post', 'easy_add_thumbnail_modded');
  add_action( 'save_post', 'easy_add_thumbnail_modded' );
  // hooks added to set the thumbnail when publishing too
  add_action('new_to_publish', 'easy_add_thumbnail_modded');
  add_action('draft_to_publish', 'easy_add_thumbnail_modded');
  add_action('pending_to_publish', 'easy_add_thumbnail_modded');
  add_action('future_to_publish', 'easy_add_thumbnail_modded');
  
} else {

    function eat_fail_requirements() {
   
      echo "<!-- Easy Add Thumbnail activated, but your WordPress doesn't support add_theme_support function -->";
    
    }
    
  add_action('wp_head', 'eat_fail_requirements');


}

?>