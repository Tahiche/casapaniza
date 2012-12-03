<?php

header("Content-Type: text/css");
header("Vary: Accept");

$url = $_SERVER['SCRIPT_NAME'];
$path = substr($url, stripos($url, "wp-content"));
$offset = $count = 0;
$strerror = "";
$relpath = "";
while (stripos($path, "/", $offset)!==false && $count<=10) {
	$offset = stripos($path, "/", $offset)+1;
	$count++;
	$relpath.= "../";
}
// include_once $relpath . 'wp-config.php';
include_once $relpath . 'wp-load.php';
include_once $relpath . 'wp-includes/wp-db.php';

global $wpdb;
$keys = "acg_lbcf_style";
$wpdb->show_errors = true;
if (!is_array($keys)) {
	$acg_mlm_keys = array($keys);
} else {
	$acg_mlm_keys = $keys;
}
$q = "SELECT * FROM " . WP_ACG_LBCF_CONFIG;
if ($key) {$q.= ' WHERE config_key="' .  $key . '"';}
$results = $wpdb->get_results($q);
foreach ($results as $row) {
	$acg_mlm_vals[$row->config_key]=$row->config_value;
}
extract($acg_mlm_vals);
echo $acg_lbcf_style;

?>