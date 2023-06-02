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
/*
$info_al = Album::info_alb($db);
$info_mu = Music::info_mus($db);
$info_ar = Artist::info_art($db);
$info_pl = Playlist::info_pla($db);
$info_us = User::info_usr($db);
#print_array($info_al);
*/
/*
$mail= User::mail_usr(1, $db);
print_r(json_encode($mail));
*/


/*$id = Artist::id_art("Alan Walker", $db);
$test = Artist::photo_art($id, $db);
print_r(json_encode($info_ar));*/

/*
Playlist::creer_playlist("RAP", 5, $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));
*/


User::ajout_usr("lemail@gmail.com", "auregs", "vfds", "2007-02-07", "jsp", "oui", "photo3",  $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));


/*
Playlist::modifier_playlist("Bonjour", 10, $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));
*/
/*
User::modifier_usr(1, "cfouche@gmail.com", "c", "fouche", "2003-08-12", "123", "FC-fou", $db);
$test = User::info_usr($db);
print_r(json_encode($test));
*/
/*
Playlist::delete_playlist(13, $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));
*/
/*
User::delete_usr(2, $db);
$test = User::info_usr($db);
print_r(json_encode($test));
*/

?>