<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);



/* desarrollo */
session_start(); /*!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
if(isset($_GET["probando"])) $_SESSION["test"] = true;
// echo "<h1>_SESSION[test] =  ". $_SESSION["test"]."</h1>";
if(!isset($_SESSION["test"])){

	echo file_get_contents("index.html");

	die();

}
/* fin desarrollo */

/** Loads the WordPress Environment and Template */
require('./wp-blog-header.php');