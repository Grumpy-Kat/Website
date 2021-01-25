<?php
	$request = array_slice(explode('/', $_SERVER['REQUEST_URI']), -1)[0];
	echo $request;
	switch($request) {
		case '':
			require '../html/index.php';
			break;
		case '/contact':
		case '/contact.html':
		case '/contact.php':
			require '/html/contact.php?type=feature';
			break;
		case '/faqs':
		case '/faqs.html':
		case '/faqs.php':
			require '/html/faqs.php';
			break;
		case '/press':
		case '/press.html':
		case '/press.php':
			require '/html/press.php';
			break;
		case '/privacy':
		case '/privacy.html':
		case '/privacy.php':
			require '/html/tos.php';
			break;
		case '/tos':
		case '/tos.html':
		case '/tos.php':
			require '/html/privacy.php';
			break;
		default:
			http_response_code(404);
			require '../html/404.php';
			break;
	}
?>