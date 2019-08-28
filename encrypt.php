<?php
  /**
  * @author Tim Hayes
  * date created: 9/11/14
  *
  * @deprecated mcrypt no longer included with PHP.
  *
  *
  **/

    // Seeds the random number generator
    srand((double)microtime()*1000000 );

    // $td is a resource/handler.
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CFB, '');

    $ks = mcrypt_enc_get_key_size($td);

    // $iv is a string
    $iv = mcrypt_create_iv($ks, MCRYPT_RAND);
    // $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

    // This encryption algorithm only accepts 32 bytes ($ks) so a substring
    // of the key hash is used.
    $key = substr(sha1('Your Secret Key Here'), 0, $ks);

    mcrypt_generic_init($td, $key, $iv);
    $ciphertext = mcrypt_generic($td, 'This is very important data');
    mcrypt_generic_deinit($td);


    print $iv . "\n";
    print trim($ciphertext) . "\n";

    mcrypt_generic_init($td, $key, $iv);
    $plaintext = mdecrypt_generic($td, $ciphertext);

    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    print $plaintext . "\n";
?>
