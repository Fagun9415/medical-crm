<?php

function my_encrypt($data) {

$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

$encryption_key = hex2bin($key);

$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);


return bin2hex($encrypted . '::' . $iv);

}

function my_decrypt($data) {

$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

$encryption_key = hex2bin($key);

list($encrypted_data, $iv) = explode('::', hex2bin($data), 2);

return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}



?>