<?php

$config = array();

$config['app_key'] = '4d31697d9779a5c8cb2a552617a6b5d8';

$config['encryption_key'] = '3V4z5nCXRFO5svJti1p2QZvK1RoPFERyKSqZafqDw6k';

$config['url_mode'] = 3;

// plugins to load - plugins will be loaded in this exact order as in array
$config['plugins'] = array(
	'HeaderRewrite',
	'Stream',
	// ^^ do not disable any of the plugins above
	'Cookie',
	'Proxify',
	'UrlForm',
	// site specific plugins below
	'Youtube',
	'Twitter'
);
$config['curl'] = array(
	//
);

return $config;

?>
