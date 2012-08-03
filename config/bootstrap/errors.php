<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\core\ErrorHandler;
use lithium\action\Response;
use lithium\net\http\Media;
use lithium\core\Environment;

ErrorHandler::apply('lithium\action\Dispatcher::run', array(), function($info, $params) {
	$response = new Response(array(
		'request' => $params['request'],
		'status' => $info['exception']->getCode()
	));
	
	// Production error templates should follow the design of the site.
	$error_layout = 'default';
	$error_template = 'production';
	
	// Development error templates can look different.
	if(Environment::is('development')) {
		$error_template = 'development';
		$error_layout = 'error';
	}
	
	Media::render($response, compact('info', 'params'), array(
		'library' => 'li3Bootstrap',
		'controller' => '_errors',
		'template' => $error_template,
		'layout' => $error_layout,
		'request' => $params['request']
	));
	return $response;
});
?>