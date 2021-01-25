<?php
	$request = trim(array_slice(explode('/', $_SERVER['REQUEST_URI']), -1)[0]);
	$request = explode('.', $request)[0];
	#echo $request;
	#require __DIR__ . '/static/index.php';
	switch($request) {
		case '':
		case 'index':
			require __DIR__ . '/static/index.php';
			break;
		case 'contact':
			require __DIR__ . '/static/contact.php';
			break;
		case 'faqs':
			require __DIR__ . '/static/faqs.php';
			break;
		case 'press':
			require __DIR__ . '/static/press.php';
			break;
		case 'privacy':
			require __DIR__ . '/static/tos.php';
			break;
		case 'tos':
			require __DIR__ . '/static/privacy.php';
			break;
		case '404':
		default:
			require __DIR__ . '/static/index.php';
			break;
	}
?>