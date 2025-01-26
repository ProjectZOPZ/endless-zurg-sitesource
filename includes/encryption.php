<?php
error_reporting(0); 


/// DO NOT CHANGE THE CODE BELOW!!!!!!!!!

$secretKey = "vu3ofAchodudaylspl0ru8riW7udr0wribabrote9huMub2uprest5j1nonuchuq";

function encrypt($data, $key) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decrypt($encryptedData, $key) {
    $cipher = "aes-256-cbc";
    list($encrypted, $iv) = explode('::', base64_decode($encryptedData), 2);
    return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
}

function generateRandomString($length = 32) {
    return substr(bin2hex(random_bytes($length)), 0, $length);
}

function GenerateAPIkey()
{
    global $secretKey;
    $future_timestamp = time() + 3600;
    $string = generateRandomString() . $future_timestamp . generateRandomString();
    $encryptedString = encrypt($string, $secretKey);
    return "SAIO: t=eyJlbm" . $encryptedString;
}

function ValidateAPIkey($apiKey)
{
    global $secretKey;
    $encryptedPart = str_replace("SAIO: t=eyJlbm", "", $apiKey);
    $decryptedString = decrypt($encryptedPart, $secretKey);
    
    if (!$decryptedString) {
        return "Invalid API key!";
    }
    $timestamp = substr($decryptedString, 32, 10);
    if ($timestamp > time()) {
        return "API key is valid!";
    } else {
        return "API key has expired!";
    }
}
?>
