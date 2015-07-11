<?php

use Proxy\Plugin\AbstractPlugin;
use Proxy\Event\ProxyEvent;

class UrlFormPlugin extends AbstractPlugin {

	public function onCompleted(ProxyEvent $event){
	
		$request = $event['request'];
		$response = $event['response'];
		
		$url = $request->getUri();
		
		// we attach url_form only if this is a html response
		if(!is_html($response->headers->get('content-type'))){
			return;
		}
		
		// this path would be relative to index.php that included it?
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
	}
}

?>