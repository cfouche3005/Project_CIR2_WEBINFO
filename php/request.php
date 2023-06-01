<?php

require_once('constant.php');
require_once('database.php');
require_once('class/Album.php');

ini_set('display_errors', 1); 
error_reporting(E_ALL);
$db = dbConnect();
#var_dump($db);

$nom_al = Album::nom();
var_dump($nom_al);
?>