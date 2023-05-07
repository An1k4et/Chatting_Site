<?php
    $dec_mess = $_COOKIE['message'];
    $key = $_COOKIE['key'];
    $dec_message = openssl_decrypt($dec_mess, "AES-128-CTR", $key, 0, '1234567891011121');
    echo $dec_message;
?>