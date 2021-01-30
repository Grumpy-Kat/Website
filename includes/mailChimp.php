<?php
	$postData = array(
		"email_address" => $_POST["mailingList"],
		"status" => "subscribed",
	);
	$request = curl_init('https://us7.api.mailchimp.com/3.0/lists/'.env("mailchimpListId").'/members/');
	curl_setopt_array(
		$request,
		array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
				'Authorization: apikey '.getenv("mailchimpKey"),
				'Content-Type: application/json'
			),
			CURLOPT_POSTFIELDS => json_encode($postData)
		)
	);
	$response = curl_exec($request);
	echo $response;
?>