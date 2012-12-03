<?php


 function acg_lbcf_load_config($keys="") {
	acg_lbcf_checktables();
	global $wpdb;
	$wpdb->show_errors = true;
	if (!is_array($keys)) {
		$acg_lbcf_keys = array($keys);
	} else {
		$acg_lbcf_keys = $keys;
	}
	$q = "SELECT * FROM " . WP_ACG_LBCF_CONFIG;
	if (isset($key) && $key) {$q.= ' WHERE config_key="' .  $key . '"';}
	$results = $wpdb->get_results($q);
	foreach ($results as $row) {
		$acg_lbcf_vals[$row->config_key]=$row->config_value;
	}
	foreach($acg_lbcf_keys as $acg_key) {
		if (!isset($acg_lbcf_vals[$acg_key])) {
			$q = sprintf('INSERT INTO ' . WP_ACG_LBCF_CONFIG . ' (config_key, config_value) VALUES ("%s", "%s")', $acg_key, "");
			$wpdb->query($q);
		}
	} 
	return $acg_lbcf_vals;
}
  
?>
