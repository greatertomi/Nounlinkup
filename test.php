<?php
// $word = "welcome-to/2htt3c@cool,.com5";
// $edited = preg_replace("/[^a-zA-Z0-9]/", "", $word);
$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);
$hashedToken = password_hash($token, PASSWORD_DEFAULT);
// echo $edited;
// echo $selector;
echo hex2bin($selector); 