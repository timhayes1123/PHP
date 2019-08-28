<?php
/**
*
* @author Tim Hayes
* date created 8/28/14
*
* Encryption test using new encryption methods.
*
**/

$password = "password";
$messageText = "some test text here.";
$method = "AES-128-CBC";
$numBytes = openssl_cipher_iv_length($method);
$strongEncrypt = true; // Passed by reference
$initVector = openssl_random_pseudo_bytes($numBytes, $strongEncrypt);
echo var_dump($strongEncrypt) . PHP_EOL;
$opt = OPENSSL_RAW_DATA;

$encryptedText = openssl_encrypt($messageText, $method, $password, $opt, $initVector);
# echo var_dump($encryptedText) . PHP_EOL;
$hashVal = hash_hmac('sha256', $encryptedText, $password, true);
# echo var_dump($hashVal) . PHP_EOL;
$usableForm = base64_encode( $initVector . $hashVal . $encryptedText );
echo var_dump($usableForm) . PHP_EOL;


/************************************************************************************/

// Trying to reverse the process

$hashLength = 32;

$weirdString = base64_decode($usableForm);
$initVector = substr($weirdString, 0, $numBytes);
$encryptedText = substr($weirdString, ($numBytes + $hashLength));
$messageText = openssl_decrypt($encryptedText, $method, $password, $opt, $initVector);
echo var_dump($messageText) . PHP_EOL;









 ?>
