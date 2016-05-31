<?php
$secretKey =  base64_encode(mcrypt_create_iv(32));
echo $secretKey;
?>