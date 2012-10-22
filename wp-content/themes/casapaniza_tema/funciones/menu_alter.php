<?php
// REF: http://erisds.co.uk/wordpress/spotlight-wordpress-admin-menu-remove-add-new-pages-or-posts-link
// functions.php
//d($GLOBALS);
function modify_menu()
{
  global $submenu;
  // d($submenu);
  //global $current_user;
 if (!current_user_can( 'manage_options' )) {
  //d($GLOBALS);
  unset($submenu['edit.php?post_type=fondo_home'][10]); 
// $submenu['edit.php?post_type=fondo_home'][3]=array("Fondo Home","edit_fondo_homes",'/wp-admin/post.php?post=135&action=edit');
 /*$submenu['/wp-admin/post.php?post=135&action=edit'][5] = array( 'Menu item name', 'publish_fondo_homes' , '/wp-admin/post.php?post=135&action=edit' );*/

 }

  // for posts it should be: 
  // unset($submenu['edit.php'][10]);
}
// call the function to modify the menu when the admin menu is drawn
add_action('admin_menu','modify_menu');

?>