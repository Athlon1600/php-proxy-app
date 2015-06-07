<?php

define('PROXY_START', microtime(true));

require("vendor/autoload.php");

use Proxy\Http\Request;
use Proxy\Http\Response;
use Proxy\Plugin\AbstractPlugin;
use Proxy\Event\FilterEvent;
use Proxy\Config;
use Proxy\Proxy;

// start the session
session_start();

// load config...
Config::load('./config.php');

if(!Config::get('app_key')){
	die("app_key inside config.php cannot be empty!");
}

// how are our URLs be generated from this point? this must be set here so the proxify_url function below can make use of it
if(Config::get('url_mode') == 1){
	Config::set('encryption_key', md5(Config::get('app_key').$_SERVER['REMOTE_ADDR']));
} else if(Config::get('url_mode') == 2){
	Config::set('encryption_key', md5(Config::get('app_key').session_id()));
}

// form submit in progress...
if(isset($_POST['url'])){
	
	$url = $_POST['url'];
	$url = add_http($url);
	
	header("HTTP/1.1 302 Found");
	header('Location: '.proxify_url($url));
	exit;
	
} else if(!isset($_GET['q'])){

	// must be at homepage - should we redirect somewhere else?
	if(Config::get('index_redirect')){
		
		// redirect to...
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: ".Config::get('index_redirect'));
		
	} else {
		echo render_template("./templates/main.php", array('version' => Proxy::VERSION));
	}

	exit;
}

// decode q parameter to get the real URL
$url = base64_decrypt($_GET['q']);

$proxy = new Proxy();

// load plugins
foreach(Config::get('plugins', array()) as $plugin){

	$plugin_class = $plugin.'Plugin';
	
	if(file_exists('./plugins/'.$plugin_class.'.php')){
	
		// use user plugin from /plugins/
		require_once('./plugins/'.$plugin_class.'.php');
		
	} else if(class_exists('\\Proxy\\Plugin\\'.$plugin_class)){
	
		// does the native plugin from php-proxy package with such name exist?
		$plugin_class = '\\Proxy\\Plugin\\'.$plugin_class;
	}
	
	// otherwise plugin_class better be loaded already and match namespace exactly \\Vendor\\Plugin\\SuperPlugin
	$proxy->getEventDispatcher()->addSubscriber(new $plugin_class());
}

// provide URL form
$proxy->getEventDispatcher()->addListener('request.complete', function($event){

	$request = $event['request'];
	$response = $event['response'];
	
	$url = $request->getUri();
	
	// we attach url_form only if this is a html response
	if(!is_html($response->headers->get('content-type'))){
		return;
	}
	
	$url_form = render_template("./templates/url_form.php", array(
		'url' => $url
	));
	
	$output = $response->getContent();
	
	// does the html page contain <body> tag, if so insert our form right after <body> tag starts
	$output = preg_replace('@<body.*?>@is', '$0'.PHP_EOL.$url_form, $output, 1, $count);
	
	// <body> tag was not found, just put the form at the top of the page
	if($count == 0){
		$output = $url_form.$output;
	}
	
	$response->setContent($output);
});


try {

	// request sent to index.php
	$request = Request::createFromGlobals();
	
	// forward it to some other URL
	$response = $proxy->forward($request, $url);
	
	// if that was a streaming response, then everything was already sent and script will be killed before it even reaches this line
	$response->send();
	
} catch (Exception $ex){

	// if the site is on server2.proxy.com then you may wish to redirect it back to proxy.com
	if(Config::get("error_redirect")){
	
		$url = render_string(Config::get("error_redirect"), array(
			'error_msg' => rawurlencode($ex->getMessage())
		));
		
		header("HTTP/1.1 302 Found");
		header("Location: {$url}");
		
	} else {
	
		echo render_template("./templates/main.php", array(
			'url' => $url,
			'error_msg' => $ex->getMessage(),
			'version' => Proxy::VERSION
		));
		
	}
}

?>