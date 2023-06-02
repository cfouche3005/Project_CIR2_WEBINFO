<?php

require_once('constant.php');
require_once('database.php');
require_once('class/Album.php');
require_once('class/Music.php');
require_once('class/Artist.php');
require_once('class/Playlist.php');
require_once('class/User.php');

/*function print_array($array) {
    print("<pre>" . print_r($array, true) . "</pre>");
}*/

ini_set('display_errors', 1); 
error_reporting(E_ALL);
$db = dbConnect();
#var_dump($db);

$info_al = Album::info_alb($db);
$info_mu = Music::info_mus($db);
$info_ar = Artist::info_art($db);
$info_pl = Playlist::info_pla($db);
$info_us = User::info_usr($db);
#print_array($info_al);

/*$id = Artist::id_art("Alan Walker", $db);
$test = Artist::photo_art($id, $db);
print_r(json_encode($info_ar));*/

Playlist::creer_playlist("electro", $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));

?>