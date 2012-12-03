<?php
/*
Plugin Name: Lightbox/Thickbox Contact Form
Plugin URI: http://www.alphachannelgroup.com/wp/lightbox_thickbox_contact_form.html
Description: An AJAX-style contact form in a lightbox / thickbox displayed on any page, post, sidebar, or in your theme.
Author: Alpha Channel Group
Version: 2.0
Author URI: http://www.alphachannelgroup.com
*/

/* Revision history:
	1.0 	- Initial releast
	1.6 	- Misc bug fixes
	2.0 	- Corrected plugin path issues
		- Revised ajax methods to use WP ajax
		- Fixed bug with email not detecting url message coming from
		- Tweaked styling
*/

if (!defined("LF")) {define("LF", "\r\n");}
$acg_lbcf_version = 1.5;

global $table_prefix;
define('WP_ACG_LBCF_CONFIG', $table_prefix . 'lightbox_contact_form');


// Function to deal with loading the contact form into pages
function acg_lightbox_contact_insert($content) {
  if (stripos($content,'[acg_lightbox_contact_form]')!==false) {
  	$acg_lbcf = acg_content_lightbox_contact_form();
	$content = str_replace("[acg_lightbox_contact_form]",$acg_lbcf,$content);
    }
  return $content;
}

function acg_lightbox_contact_link($atts) {
	extract(shortcode_atts(array(
		'linktext' => 'Contact Us'
	), $atts));
	global $post;
	return '<a href="javascript:void(0);" onclick="acg_lbcf_pop(' . $post->ID . ');">' . $linktext . '</a>';
}

 
function acg_content_lightbox_contact_form() {
	$acg_popup = false;
	$acg_config = acg_lbcf_load_config();
	include "acg_lightbox_contact_form_display.php";
	return $acg_message . $acg_content;
} 

// Function to deal with adding the mailing list menus
function acg_lbcf_menu() {
  // Set admin as the only one who can use Lightbox Contact Form for security
  $allowed_group = 'manage_options';

  // Add the admin panel pages. Use permissions pulled from above
   if (function_exists('add_menu_page')) {
       add_menu_page('Lightbox', 'Lightbox Contact Form', $allowed_group, 'acg_lightbox_contact_settings', 'acg_lightbox_contact_settings');
   }
}
  
function acg_lightbox_contact_settings() {
	acg_lbcf_checktables();
	global $wpdb;
	if (!isset($action) || !$action) {
		$action = isset($_GET["acg_action"]) ? $_GET["acg_action"] : "";
		$action = strtolower($action);
	}
	if (isset($_POST["save_item"])) {
		// This is a post, let's save, or load from post
		$acg_config = array("acg_lbcf_title", "acg_lbcf_intro", "acg_lbcf_success", "acg_lbcf_sendto", "acg_lbcf_from_email", "acg_lbcf_from_name", "acg_lbcf_style");
		foreach ($acg_config as $acg_config_key) {
			$q = sprintf('UPDATE ' . WP_ACG_LBCF_CONFIG . ' SET config_value="%s" WHERE config_key="%s"', $_POST[$acg_config_key], $acg_config_key);
			$wpdb->query($q);
		}
		extract($_POST);
	} else {
		$acg_config_keys = array("acg_lbcf_title", "acg_lbcf_intro", "acg_lbcf_success", "acg_lbcf_sendto", "acg_lbcf_from_email", "acg_lbcf_from_name", "acg_lbcf_style");
		$acg_config = acg_lbcf_load_config($acg_config_keys);
		extract($acg_config);
	}
	
	$acg_message = (isset($acg_message)) ? acg_createP($acg_message, "acg_message") : "";
	$acg_content = "";
	$acg_content.= '<h4>E-Mail Settings</h4>';
	$acg_content.= '<a class="instructions" href="#instructions">Instructions</a>';
	$acg_content.= '<div><label for="acg_lbcf_sendto">Send to email:</label><input type="text" class="text" name="acg_lbcf_sendto" value="' . $acg_lbcf_sendto . '" /></div>';
	$acg_content.= '<div><label for="acg_lbcf_from_email">From email:</label><input type="text" class="text" name="acg_lbcf_from_email" value="' . stripslashes($acg_lbcf_from_email) . '" /></div>';
	$acg_content.= '<div><label for="acg_lbcf_from_name">From name:</label><input type="text" class="text" name="acg_lbcf_from_name" value="' . stripslashes($acg_lbcf_from_name) . '" /></div>';
	$acg_content.= '<hr />';
	$acg_content.= '<h4>Form Settings</h4>';
	$acg_content.= '<div><label for="acg_lbcf_title">Title:</label><input type="text" class="text" name="acg_lbcf_title" value="' . $acg_lbcf_title . '" /></div>';
	$acg_content.= '<div><label for="acg_lbcf_style">Intro Paragraph:</label><textarea name="acg_lbcf_intro" cols="60" rows="3">' . $acg_lbcf_intro . '</textarea></div>';
	$acg_content.= '<div><label for="acg_lbcf_success">Message shown when Sent:</label><textarea name="acg_lbcf_success" cols="60" rows="3">' . $acg_lbcf_success . '</textarea></div>';
	$acg_content.= '<div><label for="acg_lbcf_style">Style:</label><small>(To reset style to default, remove all styles from below and save.)</small><textarea  class="style" name="acg_lbcf_style" cols="60" rows="40">' . $acg_lbcf_style . '</textarea>';
	$acg_content.= '<div><input type="submit" name="save_item", value="Save" class="button submit" /></div>';
	$acg_content.= '<hr /><a name="instructions"></a>';
	$acg_content.= '<h4>Instructions</h4>';
	$acg_content.= '<p>Usage:</p>';
	$acg_content.= '<ol>
				<li>To display a contact FORM in your blog post, just place the shortcode [acg_lightbox_contact_form] in your post where you&rsquo;d like the form to appear</li>
				<li>To display a LINK to display the lightbox contact form, just place the shortcode [acg_lightbox_contact_link linktext="YOUR LINK TEXT HERE"] in your post where you&rsquo;d like the link to appear (Note: Replace YOUR LINK TEXT HERE with the link text to display)</li>
				<li>To display a contact FORM in your sidebar, just drop the &ldquo;Lightbox Contact Form widget into your sidebar</li>
				<li>To display a contact LINK in your sidebar, just drop the &ldquo;Lightbox Contact Link widget into your sidebar</li>
				<li>To embed a link in your them, just enter your link as follows: &lt;a href="javascript:void(0);" onclick="acg_lbcf_pop();"&gt;Contact Us&lt/a>&gt;</li>
			</ol>
				';
	$acg_content = '<form class="acg_lbcf" name="lightbox_settings" action="?page=acg_lightbox_contact_settings" method="post"><h1>Lightbox Contact Form Settings</h1>' . $acg_message . $acg_content . '</form>';
	echo $acg_content;
}

function acg_lightbox_contact_head() {
 	acg_lightbox_contact_style();
	acg_lightbox_contact_javascript();
}

function acg_lightbox_contact_adminhead() {
	acg_lightbox_contact_style();
	echo LF . '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('url') . '/wp-content/plugins/lightbox-contact-form/style-admin.css" />';
}
 
function acg_lightbox_contact_style() {
	acg_lbcf_checktables();
	$acg_config = acg_lbcf_load_config("acg_lbcf_style");
	if (is_array($acg_config)) {
		extract($acg_config);
	}
	if (!$acg_lbcf_style) {
	$acg_lbcf_style = "
		#acg_lbcf_blur {
			display: none;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			background-color: #ccc;
			opacity: .60;
			-moz-opacity: .60;
			filter: alpha(opacity=60);
			z-index: 97;
		}
		
		#acg_lbcf_div {
			display: none;
			position: absolute;
			top: 0;
			width: 330px;
			left: 35%;
			padding: 0 10px 10px 10px;
			z-index: 99;
			border: 5px solid #555;
			background-color: White;
			height: auto;
			z-index: 99;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
		}
		
		#acg_lbcf_div h3 {
			color: #444;
			margin: 5px 0 17px 0;
		}
		
		#acg_lbcf_form div {
			clear: left;
			padding: 3px;
			text-align: left;
		}
		
		#acg_lbcf_form div label {
			float: left;
			display: block;
			width: 75px;
			text-align: right;
			margin-right: 10px;
			color: #444;
		}
		
		#acg_lbcf_form input.text {
			width: 200px;
			padding: 3px;
		}
		
		#acg_lbcf_form div textarea {
			width: 200px;
			height: 75px;
			padding: 3px;
			font-family: Arial, Helvetica, Sans-Serif;
		}
		
		#acg_lbcf_form div.submit input, form.acg_form div.submit input {
			margin-left: 95px;
			margin-right: 15px;
			font-weight: bold;
			color: #666;
			font-size: 9pt;
		}
		
		#acg_lbcf_form.lbcf_widget div label {
			float: none;
			display: inline;
			text-align: left;
		}
		
		#acg_lbcf_form.lbcf_widget input.text {
			width: 100%;
		}
		
		#acg_lbcf_form.lbcf_widget div textarea {
			width: 100%;
		}
		
		#acg_lbcf_form.lbcf_widget div.submit input, form.acg_form.lbcf_widget div.submit input {
			margin-left: 0;
		}
		
		#acg_lbcf_div p.intro {
			text-align: left;
			margin: 0 20px 10px 20px;
		}
		
		#acg_lbcf_div p.error {
			border: 1px solid #900;
			background-color: #ffc;
			font-weight: bold;
			text-align: left;
			padding: 10px;
			margin: 10px 20px 5px 20px;
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			color: #444;
		}
		
		";
		global $wpdb;
		$q = sprintf('UPDATE ' . WP_ACG_LBCF_CONFIG . ' SET config_value="%s" WHERE config_key="%s"', mysql_real_escape_string($acg_lbcf_style), "acg_lbcf_style");
		$wpdb->query($q);	
	}
	$acg_lbcf_style = "<style type='text/css'>" . stripslashes($acg_lbcf_style) . "</style>";
	// echo $acg_lbcf_style;
	echo LF . '<link rel="stylesheet" href="' . get_bloginfo("url") . '/wp-content/plugins/lightbox-contact-form/style.php" />';
	
}

class acg_lightbox_contact_form extends WP_Widget {
	function acg_lightbox_contact_form() {
		parent::WP_Widget('acg_lightbox_contact_form', 'Lightbox Contact Form', array('description'=>'Displays the lightbox contact form'));
	}
	
	function widget($args, $instance) {
		extract($args);
		$options = $instance;
		echo $before_widget;
		$acg_popup = false;
		$acg_config = acg_lbcf_load_config();
		$acg_lbcf_class = "lbcf_widget";
		include "acg_lightbox_contact_form_display.php";
		echo $acg_message . $acg_content;
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// $instance['link-text'] = strip_tags(stripslashes($new_instance["link-text"]));
		return $instance;
	}
	
	function form($instance) {
		echo 'These settings are controlled here: <a href="' . get_bloginfo("url") . '/wp-admin/admin.php?page=acg_lightbox_contact_settings">Lightbox Contact Form Settings</a>';
	}
}


class acg_lightbox_contact_link extends WP_Widget {
	function acg_lightbox_contact_link() {
		parent::WP_Widget('acg_lightbox_contact_link', 'Lightbox Contact Link', array('description'=>'Displays a link that will in turn display the Lightbox Contact Form'));
	}
	
	function widget($args, $instance) {
		extract($args);
		$options = $instance;
		echo $before_widget;
		echo '<a href="javascript:void(0);" onclick="acg_lbcf_pop(' . $post->ID . ');">' . $instance["link-text"] . '</a>';
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['link-text'] = strip_tags(stripslashes($new_instance["link-text"]));
		return $instance;
	}
	
	function form($instance) {
		$default = 	array( 'link-text' => 'Contact Us');
		$instance = wp_parse_args( (array) $instance, $default );
		foreach ($default as $k=>$v) {
			echo "\r\n".'<p><label for="' . $this->get_field_name($k) . '">' . str_replace("-", " ", $k) . ': <input type="text" class="widefat" id="' . $this->get_field_id($k) . '" name="' . $this->get_field_name($k) . '" value="'.esc_attr($instance[$k]).'" /><label></p>';
		}
	}
}



function acg_lightbox_contact_javascript() {
	$url = plugins_url("lightbox-contact-form");
	wp_enqueue_script('acg-lbcf-pop', $url . '/acg_lightbox_contact.js', array('jquery'));
	global $post;
	$postid = (isset($post) && isset($post->ID)) ? $post->ID : '';
	wp_localize_script('acg-lbcf-pop', 'acgAjax', 
		array('ajaxurl' => admin_url( 'admin-ajax.php' ),
			'postID' => $postid,
			'postNonce' => wp_create_nonce( 'acg-lbcf-pop-comment-nonce')) 
	);
	// echo LF . '<script type="text/javascript">var acg_lbcf_url = "' . $url . '/acg_lightbox_contact_form.php"</script>';
}

function acg_lightbox_contact_footer() {
	echo '<div id="acg_lbcf_blur"></div><div id="acg_lbcf_wrap"><div id="acg_lbcf_div"></div></div>' . LF;
}


function acg_lbcf_checktables() {
	global $wpdb;
	if ($wpdb->get_var("SHOW TABLES LIKE '" . WP_ACG_LBCF_CONFIG . "'") != WP_ACG_LBCF_CONFIG) {
		$sql = "CREATE TABLE " . WP_ACG_LBCF_CONFIG . " (
                        config_id INT(11) NOT NULL AUTO_INCREMENT,
			config_key VARCHAR(50) NULL,
			config_value TEXT NULL,
                        PRIMARY KEY (config_id))";
		$wpdb->query($sql);
	}
}

 
function acgAjax_submit() {
    $nonce = $_POST['postNonce'];
    $postid = $_POST["postID"];
    // check to see if the submitted nonce matches with the
    // generated nonce we created earlier
    if ( ! wp_verify_nonce( $nonce, 'acg-lbcf-pop-comment-nonce' ) ) {
        die ( 'Busted!');
    }
 
    // generate the response
    $response = json_encode( array( 'success' => true ) );
 
   $acg_config = acg_lbcf_load_config();
   $acg_popup = 1;
   require "acg_lightbox_contact_form_display.php";
 
    // IMPORTANT: don't forget to "exit"
    exit;
}

require_once "acg_load_config.php";

function register_acg_lbcf_display() {
	wp_enqueue_script( 'jquery' );
	register_widget("acg_lightbox_contact_form");
	register_widget("acg_lightbox_contact_link");
}

add_action('admin_menu', 'acg_lbcf_menu');
add_action('admin_head', 'acg_lightbox_contact_adminhead');
// Enable the ability for the contact form to be loaded from pages
add_filter('the_content','acg_lightbox_contact_insert');
// Enable the ability to style the stuff
add_action('wp_head', 'acg_lightbox_contact_head');
// Enable the addition of the javascript thickbox
add_action('wp_footer', 'acg_lightbox_contact_footer');

add_action("init", 'register_acg_lbcf_display', 1);

add_shortcode('acg_lightbox_contact_link', 'acg_lightbox_contact_link');

add_action( 'wp_ajax_nopriv_acgAjax-submit', 'acgAjax_submit' );
add_action( 'wp_ajax_acgAjax-submit', 'acgAjax_submit' );


?>