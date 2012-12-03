<?php
	error_reporting(0);
	global $formid;
	$formid++;
	if ($acg_popup) {$formid="pop";}
    	$acg_lbcf_name = "";
	$acg_lbcf_email = "";
	$acg_lbcf_message = "";
	$acg_message = "";
	$acg_posted = $acg_die = false;
	$action = (isset($_GET["action"])) ? $_GET["action"] : "";
	if (!$action) {
		$action = (isset($_POST["action"])) ? $_POST["action"] : "";
	}
	$confirm = (isset($_GET["confirm"])) ? 1 : 0;
	$confirm = (!$confirm) ? 0 : $confirm;
	$action = strtolower($action);
	
	$url = $_GET["url"];
	
	if (isset($_GET["submit"])) {
		extract($_GET);
		$acg_posted = true;
	} elseif (isset($_POST["submit"])) {
		extract($_POST);
		$acg_posted = true;
	}
	// In the event the page is being displayed IN a page (rather than via the lightbox), get the URL
	if (!$url) {
		global $post;
		$url = get_permalink($post->ID);
	}
	
	if ($submit) {
		if (!$acg_lbcf_name) {
			$acg_message.= "Por favor introduzca su nombre.<br />";
		}
		if (strlen($acg_lbcf_email) < 5) {
			$acg_message.= "Por favor introduzca su email. <br />";
		}
		if (strlen($acg_lbcf_message) < 10) {
			$acg_message.= "Por favor introduzca un mensaje. <br />";
		}
		if (!$acg_message) {
			error_reporting(0);
			$to = $acg_config["acg_lbcf_sendto"];
			$fromemail = $acg_config["acg_lbcf_from_email"];
			$fromname = $acg_config["acg_lbcf_from_name"];
			$from = ($fromname) ? stripslashes($fromname) . ' <' . stripslashes($fromemail) . '>' : stripslashes($fromemail);
			$from = "From: " . $from . "\r\n";
			$acg_lbcf_message = "La siguiente persona ha enviado un mensaje:\r\n" . $acg_lbcf_name . "\r\n" . $acg_lbcf_email . "\r\n\r\nMessage:\r\n" . $acg_lbcf_message; 
			global $post;
			$url = ($post->ID) ? get_permalink($post->ID) : "";
			$url = (!$url && $postid) ? get_permalink($postid) : $url;
			$acg_lbcf_message.= "\r\n\r\n(desde la página: " . urldecode($url) . ")";
			$results = wp_mail($to, "WordPress Blog Contact Form", $acg_lbcf_message, $from);
			if ($results===true) {
				$acg_message = ($acg_config["acg_lbcf_success"]) ? $acg_config["acg_lbcf_success"] : "Your message has been sent.  Thank you!";
			} else {
				$acg_message = "Ha ocurrido un error al enviar el mensaje.";
			}
			$acg_die = true;
		}
	}
	
	$acg_button = "Enviar";
	
	if (!$acg_posted || $acg_message) {
		// Build Contact form
		$acg_content = "";
		$acg_content.= '<div><label for="acg_lbcf_name">Nombre</label><input type="text" class="text input' . $formid . '" name="acg_lbcf_name" value="' . $acg_lbcf_name . '" /></div>';
		$acg_content.= '<div><label for="acg_lbcf_email">Email</label><input type="text" class="text input' . $formid . '" name="acg_lbcf_email" value="' . $acg_lbcf_email . '" /></div>';
		$acg_content.= '<div><label for="acg_lbcf_message">Mensaje</label><textarea name="acg_lbcf_message" cols="32" rows="6" class="input' . $formid . '">' . $acg_lbcf_message . '</textarea></div>';
		$acg_content.= '<input type="hidden" class="input' . $formid . '"name="url" value="' . $url . '" />';
		$acg_onclick = ($acg_popup) ? 'lbcf_hideLoading(); return false;' : '';
		$acg_onclick = ($acg_onclick) ? ' onclick="' . $acg_onclick . '"' : '';
		$acg_content.= '<div class="submit"><input type="submit" class="submit inputpop" name="submit" value="' . $acg_button . '">' . '<a href="' . get_permalink() . '"' . $acg_onclick . '>Cancelar</a></div>'; 
	}
	$acg_onclick = ($acg_popup) ? ' onsubmit="return acg_lbcf_submit(\'' . $formid . '\');"' : '';
	$acg_lbcf_class.= " acg_lbcf_form_" . $formid;
	$acg_lbcf_class = ($acg_lbcf_class) ? 'class="' . $acg_lbcf_class . '"' : '';
	$acg_content = '<form name="acg_lbcf_form" id="acg_lbcf_form" ' . $acg_lbcf_class . ' method="post" action="' . get_permalink() . '"' . $acg_onclick . '>' . $acg_content . '</form>';
	$acg_message = ($acg_message) ? "<p class='error'>" . stripslashes($acg_message) . "</p>" : "";
	$title = $acg_config["acg_lbcf_title"];
	$title = (!$title) ? "Send us a Message" : $title;
	$para = $acg_config["acg_lbcf_intro"];
	$para = ($para) ? '<p class="intro">' . $para . '</p>' :'';
	if ($acg_die && $acg_popup) {
		$acg_content = "";
		$acg_message = "1|" . $acg_message;
	}
	if ($acg_popup && !$acg_die) {
		echo "<h3>" . stripslashes($title) . "</h3>" . stripslashes($para);
	}
	if ($acg_popup) {
		echo trim($acg_message);
		if (!$acg_die) {
			echo $acg_content;
		}
	} else {
		if ($acg_die) {
			$acg_content = "";
		}
	}
	
?>
