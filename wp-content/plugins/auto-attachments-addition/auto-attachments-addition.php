<?php
/*
Plugin Name: Auto Attachments Addition for Attachments Plugin
Description: This plugin makes your attachments more effective. Supported attachment types are Word, Excel, Pdf, 
Author: Tahi
*/
// Stop direct call
if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
				die('You are not allowed to call this page directly.');
}

/*function get_all_added_attachment_icons(){
	return get_attachment_icons();
	}*/
//

// Function Area 
function get_all_added_attachment_icons( ) {
				$opts 			   = get_option('auto_attachments_options');
				$urlp              = plugins_url('/auto-attachments/includes');
				$before_title_text = $opts['before_title'];
				$b_title           = $opts['show_b_title'];
				$aa_string         = "<div class='dIW2'>";
				
				/*d($files = get_children(array( //do only if there are attachments of these qualifications
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment'
								)));*/
				//if($attachments = attachments_get_attachments()){ $files=$attachments;
				$attachmentsArr = attachments_get_attachments();
				//d($attachmentsArr);
				$attachedObjs=array();
				foreach($attachmentsArr as $idattch=>$attach){
					$attachedObjs[$attach['id']]=get_post($attach['id']);
					$attachedObjs[$attach['id']]->origArr=$attach;
					}
				//d($attachedObjs);
				
				$filesMedia = get_children(array( //do only if there are attachments of these qualifications
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'numberposts' => -1,
								'post_mime_type' => array(
												"application/pdf",
												"application/rar",
												"application/msword",
												"application/vnd.ms-powerpoint",
												"application/vnd.ms-excel",
												"application/zip",
												"application/x-rar-compressed", 
												"application/x-tar",
												"application/x-gzip",
												"application/vnd.oasis.opendocument.spreadsheet",
												"application/vnd.oasis.opendocument.formula",
												"text/plain", 
												"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
												"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
												"application/vnd.openxmlformats-officedocument.presentationml.presentation",
												"application/x-compress",
												"application/mathcad",
												"application/postscript"
								) //MIME Type condition (changed into this format with 0.4.1)
				));
						
				if ($b_title == 'yes') {
								$aa_string .= "$before_title_text<br />";
				} else {
				}
				if ($opts['listview'] == 'yes') {
								$aa_string .= "<ul>";
				}
				$files = array_merge($filesMedia, $attachedObjs);
				
				if ($files) {
				
				/*array_push($files, $attachedObjs);*/
				//d($files);
				
				
								foreach ($files as $num=>$file) //setup array for more than one file attachment
												{
												$fhh = $opts['fhh'];
												$fhw = $opts['fhw'];
												if ($opts['newwindow'] == 'yes') {
																$target = 'target="_blank"';
												} else {
																$target = "";
												}
												$file_link       = wp_get_attachment_url($file->ID); //get the url for linkage
												$file_name_array = explode("/", $file_link);
												$file_post_mime  = str_replace("/", "-", $file->post_mime_type);
												$file_name       = array_reverse($file_name_array); //creates an array out of the url and grabs the filename
												/*$alt =  get_post_meta($file->ID);
												 d(get_post_meta($file->ID, 'thumb', true));
												d($file->origArr);*/
												$titfile=$file->origArr['title']?$file->origArr['title']:$file->post_title;
												
																																 
												
												if ($opts['listview'] == 'yes') {
																$aa_string .= "<li id='$file->ID'>";
																$aa_string .= "<a style='font-weight:bold;text-decoration:none;' href='$file_link' $target><span class='ikon kaydet'></span>" . $file->post_title . "</a> ";
																$aa_string .= "</li>";
												} else {
																$aa_string .= "<div class='dI attchnum$num' id='$file->ID'>";
																$aa_string .= "<a href='$file_link' $target>";
																$aa_string .= "<img src='$urlp/images/mime/" . $file_post_mime . ".png' width='$fhw' height='$fhh'/>";
																$aa_string .= "</a>";
																
																$aa_string .= "<a class='dItitle' href='$file_link'>" . $titfile. "</a>";
																$aa_string .= "</div>";
												}
								}
				}
				if ($opts['listview'] == 'yes') {
								$aa_string .= "</ul>";
				}
				$aa_string .= "</div><div style='clear:both;'></div>";
				//Audio Files
				$mp3s = get_children(array( //do only if there are attachments of these qualifications
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'numberposts' => -1,
								'post_mime_type' => 'audio' //MIME Type condition
				));
				if (!empty($mp3s)):
								$skin = $opts['jwskin'];
								$jhw  = $opts['jhw'];
								$aa_string .= "<div class='dIW'><div class='mp3info'>" . $opts['mp3_listen'] . "</div><ul>";
								$aa_string .= "<script language='javascript' type='text/javascript' src='$urlp/jw/swfobject.js'></script>";
								foreach ($mp3s as $mp3):
												$aa_string .= "<li>";
												if (!empty($mp3->post_title)): //checking to make sure the post title isn't empty
												endif;
												if (!empty($mp3->post_content)): //checking to make sure something exists in post_content (description)
												endif;
												$aa_string .= "<div id='mediaspace" . $mp3->ID . "'></div>";
												$aa_string .= "<script type='text/javascript'>";
												$aa_string .= "var so = new SWFObject('$urlp/jw/player.swf','ply','$jhw','24','9','#000000');";
												$aa_string .= "so.addParam('allowfullscreen','false');";
												$aa_string .= "so.addParam('allowscriptaccess','always');";
												$aa_string .= "so.addParam('wmode','opaque');";
												$aa_string .= "so.addVariable('file','" . $mp3->guid . "');";
												$aa_string .= "so.addVariable('skin','" . $urlp . "/jw/skins/" . $skin . ".zip');";
												$aa_string .= "so.write('mediaspace" . $mp3->ID . "');";
												$aa_string .= "</script>";
												$aa_string .= "<span class='mp3title'>" . $mp3->post_title . " - " . $mp3->post_content . "</span>";
												$aa_string .= "</li>";
								endforeach;
								$aa_string .= "</ul></div>";
				endif;
				//Video Support flv, mp4, etc. added with 0.2
				$videoss = get_children(array( //do only if there are attachments of these qualifications
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'numberposts' => -1,
								'post_mime_type' => 'video' //MIME Type condition
				));
				if (!empty($videoss)):
								$jhw  = $opts['jhw'];
								$jhh  = $opts['jhh'];
								$aa_string .= "<div class='dIW'><div class='videoinfo'>" . $opts['video_watch'] . "</div><ul>";
								$aa_string .= "<script language='javascript' type='text/javascript' src='$urlp/jw/swfobject.js'></script>";
								foreach ($videoss as $videos):
												$aa_string .= "<li>";
												if (!empty($videos->post_title)): //checking to make sure the post title isn't empty
												endif;
												if (!empty($videos->post_content)): //checking to make sure something exists in post_content (description)
												endif;
												$aa_string .= "<div id='mediaspace" . $videos->ID . "'></div>";
												$aa_string .= "<script type='text/javascript'>";
												$aa_string .= "var so = new SWFObject('$urlp/jw/player.swf','ply','$jhw','$jhh','9','#000000');";
												$aa_string .= "so.addParam('allowfullscreen','true');";
												$aa_string .= "so.addParam('allowscriptaccess','always');";
												$aa_string .= "so.addParam('wmode','opaque');";
												$aa_string .= "so.addVariable('file','" . $videos->guid . "');";
												$aa_string .= "so.addVariable('skin','" . $urlp . "/jw/skins/" . $skin . ".zip');";
												$aa_string .= "so.write('mediaspace" . $videos->ID . "');";
												$aa_string .= "</script>";
												$aa_string .= "<span class='mp3title'>" . $videos->post_title . " - " . $videos->post_content . "</span>";
												$aa_string .= "</li>";
								endforeach;
								$aa_string .= "</ul></div>";
				endif;
				if ($opts['galeri'] == 'yes') {
								global $blog_id, $current_site;
								$thumb_ID = get_post_thumbnail_id( get_the_ID());
								if ($galeriresim = get_children(array( //do only if there are attachments of these qualifications
												'post_parent' => get_the_ID(),
												'post_type' => 'attachment',
												'numberposts' => -1,
												'post_mime_type' => 'image', //MIME Type condition
												'exclude' => $thumb_ID
								))) {
												$aa_string .= "<div class='dIW1'><div class='galeri-".$opts['galstyle']."'>";
												foreach ($galeriresim as $galerir) //setup array for more than one file attachment
																{
																$file_link       = wp_get_attachment_url($galerir->ID); //get the url for linkage
																$file_name_array = explode("/", $galrerir_link);
																$aath            = wp_get_attachment_image_src($galerir->ID, 'aa_thumb');
																$aabg            = wp_get_attachment_image_src($galerir->ID, 'aa_big');
																$aa_string .= "<a href='$aabg[0]' rel='lightbox-grp'>";
																if (isset($blog_id) && $blog_id > 1) //fix for TimThumb
																				{
																				$image_link_parts = explode("/files/", $galerir->guid); //fix for TimThumb
																				$aa_string .= "<img src='$aath[0]'/>";
																				$aa_string .= "</a>";
																} else {
																				$aa_string .= "<img src='$aath[0]'/>";
																				$aa_string .= "</a>";
																}
												}
												$aa_string .= "</div></div>";
								}
				}
				$aa_string .= "<div style='clear:both;'></div>";
				// Last Check for attachments (Needed After "Before Title option") Thanks Kris! :)
				$aargu = get_children(array(
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'numberposts' => -1
				));
				if (!empty($aargu) || !empty($files)):
								return $aa_string;
				endif;
}