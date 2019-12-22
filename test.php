<?php
$word = "welcome-to/2htt3c@cool,.com5";
$edited = preg_replace("/[^a-zA-Z0-9]/", "", $word);

echo $edited;
