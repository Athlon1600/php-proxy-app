<?php

function generate_random_key(){

	if(function_exists('openssl_random_pseudo_bytes')){
		$random = openssl_random_pseudo_bytes(100);
	} else {
		$random = rand().microtime().rand();
	}
	
	return md5($random);
}

$path_config = './config.php';

// config.php won't be writable if ran from within web server
if(!is_writable($path_config)){
	exit;
}

$key = generate_random_key();

// open config.php
$config = file_get_contents($path_config);

// replace blank app_key with new generated key
$config = str_replace('$config[\'app_key\'] = \'\';', '$config[\'app_key\'] = \''.$key.'\';', $config);

// write to config.php
file_put_contents($path_config, $config);

echo "New Key: {$key}\r\n";

?>