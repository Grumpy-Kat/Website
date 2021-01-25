<?php
	$request = trim(array_slice(explode('/', $_SERVER['REQUEST_URI']), -1)[0]);
	var $redirect = '';
	switch($request) {
		case '':
		case '/':
		case '/index' :
		case '/index.html':
		case '/index.php':
			$redirect = __DIR__ . '/html/index.php';
			break;
		case '/contact':
		case '/contact.html':
		case '/contact.php':
			$redirect = __DIR__ . '/html/contact.php?type=feature';
			break;
		case '/faqs':
		case '/faqs.html':
		case '/faqs.php':
			$redirect = __DIR__ . '/html/faqs.php';
			break;
		case '/press':
		case '/press.html':
		case '/press.php':
			$redirect = __DIR__ . '/html/press.php';
			break;
		case '/privacy':
		case '/privacy.html':
		case '/privacy.php':
			$redirect = __DIR__ . '/html/tos.php';
			break;
		case '/tos':
		case '/tos.html':
		case '/tos.php':
			$redirect = __DIR__ . '/html/privacy.php';
			break;
		default:
			http_response_code(404);
			require __DIR__ . '/html/404.php';
			break;
	}
	header('Location: ' . $redirect, true, 301);
	die();	
?>