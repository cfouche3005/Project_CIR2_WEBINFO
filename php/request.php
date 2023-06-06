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
Playlist::creer_playlist("POP", 3, $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));
*/

/*
User::ajout_usr("addmail@gmail.com", "autre", "penelope", "1998-05-16", "unmdpprojet", "or", "photo9",  $db);
$test = User::info_usr($db);
print_r(json_encode($test));
*/
//print_r(json_encode(User::modifier_usr_sans_mdp(2, "autremail8@gmail.com", "autre", "penelope", "1998-05-16", "or",  $db)));


/*
print_r(User::id_usr("leautrddeprojet@gmail.com", $db));
*/

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
Playlist::delete_playlist(3, $db);
$test = Playlist::info_pla($db);
print_r(json_encode($test));
*/
/*
User::delete_usr(3, $db);
$test = User::info_usr($db);
print_r(json_encode($test));
*/
/*
$method = $_SERVER['REQUEST_METHOD'];

$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request); 
$requestRessource = array_shift($request);
*/


/*
$test=Album::info_album('2ecdc503-8f4e-488c-aee2-d35d87916021', $db);
echo json_encode($test);
*/
//$test = Album::info_album('2ecdc503-8f4e-488c-aee2-d35d87916021', $db);
//echo json_encode($test);

//print_r(json_encode(Playlist::get_music_playlist(1, $db)));

//print_r(json_encode(User::info_usr_by_id(1, $db)));



//Artist::info_artiste('847f8b9d-b8c5-408f-aa42-ab8fa67d10c5', $db);



$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'];

switch ($method){
    case 'GET':
        switch($path){
            case '/content/album':
                if(isset($_GET['id_album'])){
                    $id_album = $_GET['id_album'];
                    $response = Album::info_album($id_album, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    
                    exit;
                }
                break;
            case '/user/playlists':
                if(isset($_GET['id_user'])){
                    $id_user = $_GET['id_user'];
                    $response = Playlist::playlist_user($id_user,$db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    exit;
                }
                break;
            case '/user/playlists/like':
                if(isset($_GET['id_music']) && isset($_GET['id_user'])){
                    $id_music = $_GET['id_music'];
                    $id_user = $_GET['id_user'];
                    $response = Music::verif_music_like($id_music, $id_user, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');

                    exit;
                }
                break;
            case '/user/content/playlist':
                if(isset($_GET['id_playlist'])){
                    $id_playlist = $_GET['id_playlist'];
                    $response = Playlist::get_music_playlist($id_playlist, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    exit;
                }
                break;
        }
        break;
        
    case 'POST':
        switch($path){
            case '/auth/register':
                if(isset($_POST['lastname']) && isset($_POST['surname']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['pseudo']) && isset($_POST['birthdate'])){
                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['surname'];
                    $mail = $_POST['mail'];
                    $password = $_POST['password'];
                    $birthdate = $_POST['birthdate'];
                    $pseudo = $_POST['pseudo'];
                    $response = User::ajout_usr($mail, $lastname, $firstname, $birthdate, $password, $pseudo, 'tbd', $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    exit;
                }
                break;

            case '/auth/login':
                if(isset($_POST['mail']) && isset($_POST['password'])){
                    $mail = $_POST['mail'];
                    $password = $_POST['password'];
                    $response = User::login_usr($mail, $password, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    exit;
                }
                break;
            case '/user/playlists':
                if(isset($_POST['nom_playlist']) && isset($_POST['id_user'])){
                    $id_user = $_POST['id_user'];
                    $nom_playlist = $_POST['nom_playlist'];
                    $response = Playlist::creer_playlist($nom_playlist, $id_user, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    exit;
                }
                break;
            case '/user/playlists/like':
                if(isset($_POST['id_music']) && isset($_POST['id_user'])){
                    $id_music = $_POST['id_music'];
                    $id_user = $_POST['id_user'];
                    $response = Music::ajout_music_like($id_music, $id_user, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');

                    exit;
                }
                break;
            default :
                header('HTTP/1.1 400 Bad Request');
                exit;
        }
        break;
        
    case 'DELETE':
        switch($path) {
            case '/user/playlists':
                if(isset($_GET['id_playlist'])){
                    $id_playlist = $_GET['id_playlist'];
                    $response = Playlist::delete_playlist($id_playlist, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');
                    exit;
                }
                break;
            case '/user/playlist/like':
                if(isset($_GET['id_music']) && isset($_GET['id_user'])){
                    $id_music = $_GET['id_music'];
                    $id_user = $_GET['id_user'];
                    $response = Music::ajout_music_like($id_music, $id_user, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad Request');

                    exit;
                }
                break;
        }
        break;

    case 'PUT':
        switch($path) {
            case '/user/playlists':
                parse_str(file_get_contents('php://input'), $_PUT);
                if(isset($_PUT['nom_playlist']) && isset($_PUT['id_playlist'])){
                    $id_playlist = $_PUT['id_playlist'];
                    $nom_playlist = $_PUT['nom_playlist'];
                    $response = Playlist::modifier_playlist($nom_playlist, $id_playlist, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                else{
                    header('HTTP/1.1 400 Bad PUT Request');
                    exit;
                }
                break;
            case '/user/profile':
                parse_str(file_get_contents('php://input'), $_PUT);
                if(isset($_PUT['id_user']) && isset($_PUT['lastname']) && isset($_PUT['surname']) && isset($_PUT['mail']) && isset($_PUT['password']) && isset($_PUT['pseudo']) && isset($_PUT['birthdate']) && isset($_PUT['mp']) && $_PUT['mp'] == 'true'){
                    $id_user = $_PUT['id_user'];
                    $lastname = $_PUT['lastname'];
                    $firstname = $_PUT['surname'];
                    $mail = $_PUT['mail'];
                    $password = $_PUT['password'];
                    $birthdate = $_PUT['birthdate'];
                    $pseudo = $_PUT['pseudo'];
                    $response = User::modifier_usr($id_user, $mail, $lastname, $firstname, $birthdate, $password, $pseudo, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }
                elseif(isset($_PUT['id_user']) && isset($_PUT['lastname']) && isset($_PUT['surname']) && isset($_PUT['mail']) && isset($_PUT['pseudo']) && isset($_PUT['birthdate']) && isset($_PUT['mp']) && $_PUT['mp'] == 'false'){
                    $id_user = $_PUT['id_user'];
                    $lastname = $_PUT['lastname'];
                    $firstname = $_PUT['surname'];
                    $mail = $_PUT['mail'];
                    $birthdate = $_PUT['birthdate'];
                    $pseudo = $_PUT['pseudo'];
                    $response = User::modifier_usr_sans_mdp($id_user, $mail, $lastname, $firstname, $birthdate, $pseudo, $db);
                    header('Content-Type: application/json; charset=utf-8');
                    header('Cache-control: no-store, no-cache, must-revalidate');
                    header('Pragma: no-cache');
                    header('HTTP/1.1 200 OK');
                    echo json_encode($response);
                }

                else{
                    header('HTTP/1.1 400 Bad PUT Request');
                    exit;
                }
                break;
        }
        break;
}

?>