<?php

// all possible options will be stored
$config = array();

// make it as long as possible for extra security... secret key is being used when encrypting urls
$config['secret_key'] = '';

// plugins to load - plugins will be loaded in this exact order as in array
$config['plugins'] = array(
	'Test',
	'Stream',
	'HeaderRewrite',
	'Cookie',
	'Proxify',
	// site specific plugins
	'Youtube',
	'DailyMotion',
	'RedTube',
	'XHamster',
	'XVideos',
	'Twitter'
);

// additional curl options to go with each request
$config['curl'] = array(
	//CURLOPT_INTERFACE => '123.123.123.13',
	//CURLOPT_USERAGENT => 'Firefox 5000'
);

//$config['error_redirect'] = "https://unblockvideos.com/#error={error_msg}";
//$config['index_redirect'] = 'https://unblockvideos.com/';

// this better be here other Config::load fails
return $config;

?>