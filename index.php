<?php
	$request = trim(array_slice(explode('/', $_SERVER['REQUEST_URI']), -1)[0]);
	require __DIR__ . '/static/index.php';
	/*echo __DIR__;
	switch($request) {
		case '':
		case '/':
		case '/index' :
		case '/index.html':
		case '/index.php':
		case 'app':
		case '/app/':
		case '/app/index' :
		case '/app/index.html':
		case '/app/index.php':
			require __DIR__ . '/static/index.php';
			break;
		case '/contact':
		case '/contact.html':
		case '/contact.php':
			require __DIR__ . '/static/contact.php?type=feature';
			break;
		case '/faqs':
		case '/faqs.html':
		case '/faqs.php':
			require __DIR__ . '/static/faqs.php';
			break;
		case '/press':
		case '/press.html':
		case '/press.php':
			require __DIR__ . '/static/press.php';
			break;
		case '/privacy':
		case '/privacy.html':
		case '/privacy.php':
			require __DIR__ . '/static/tos.php';
			break;
		case '/tos':
		case '/tos.html':
		case '/tos.php':
			require __DIR__ . '/static/privacy.php';
			break;
		default:
			require __DIR__ . '/static/index.php';
			break;
	}*/
?>