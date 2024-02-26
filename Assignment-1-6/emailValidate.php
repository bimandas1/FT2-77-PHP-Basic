<?php
    /**
     * Validate the Email
     * @param [string] $email
     * @return boolean
     */
    function isValidEmail($email) : bool {
        /** Get the API Key */
        require 'creds.php';

        $ch = curl_init();

        curl_setopt_array($ch, [
            /** API call */
            CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE
        ]);

        $response = curl_exec($ch);

        /** JSON decoding */
        $data = json_decode($response, TRUE);

        if($data['deliverability'] == "DELIVERABLE"){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
?>
