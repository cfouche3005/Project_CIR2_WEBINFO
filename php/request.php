<?php

require_once('constant.php');
require_once('database.php');
require_once('class/Album.php');

function print_array($array) {
    print("<pre>" . print_r($array, true) . "</pre>");
}

ini_set('display_errors', 1); 
error_reporting(E_ALL);
$db = dbConnect();
#var_dump($db);

$info_al = Album::info_alb();
$id_al = Album::id_alb("Walkerverse Pt. II");
print_array($info_al);
?>