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

$info_al = Album::info_alb();
$info_mu = Music::info_mus();
$info_ar = Artist::info_art();
$info_pl = Playlist::info_pla();
$info_us = User::info_usr();
#print_array($info_al);

/*$id = Artist::id_art("Alan Walker");
$test = Artist::photo_art($id);
print_r(json_encode($info_ar));*/
?>