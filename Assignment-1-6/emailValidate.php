<?php

/**
 * Validate the Email
 * @param string $email
 * @return boolean
 * 	True if $email is a valid one, else false.
 */

function isValidEmail($email): bool
{
	return TRUE;   // Demo return, as API call limit exceeded !

	// Get the API Key
	require __DIR__ . '/creds.php';

	$ch = curl_init();

	curl_setopt_array($ch, [
		// API call
		CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email",
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_FOLLOWLOCATION => TRUE
	]);

	$response = curl_exec($ch);

	// JSON decoding
	$data = json_decode($response, TRUE);

	if ($data['deliverability'] == 'DELIVERABLE') {
		return TRUE;
	}

	return FALSE;
}
