<?php
require_once ('database.php');
class Album
{
    // Récupère les infos de tous les albums
    public static function list_alb($conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM album';
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère toutes les lignes et les renvoie sous forme de tableau associatif
            }
        } catch (PDOException $exception) { // Gestion des erreurs, renvoie false dès qu'une erreur est rencontrée
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }

    // Récupère l'id de l'album à partir de son nom
    public static function id_alb($nom_album, $conn) {
        try {
            
            $sql = 'SELECT id_album FROM album WHERE nom_album = :nom_album';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_album', $nom_album);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['id_album'];
    }

    // Récupère la date de l'album à partir de son id
    public static function date_alb($id_album, $conn) {
        try {
            
            $sql = 'SELECT date_album FROM album WHERE id_album = :id_album';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['date_album']; 
    }

    // Récupère l'image de l'album à partir de son id
    public static function image_alb($id_album, $conn) {
        try {
            
            $sql = 'SELECT image_album FROM album WHERE id_album = :id_album';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['image_album'];
    }

    // Récupère le type de l'album à partir de son id
    public static function type_alb($id_album, $conn) {
        try {
            
            $sql = 'SELECT type_album_val FROM album_appartient_type WHERE id_album = :id_album';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['type_album_val'];
    }
    //fonction qui a partir de l'id d'un album retourne toutes les infos et musiques de l'album
    public static function info_album($id_album, $conn){
        try {
            
            $sqlAlbum= 'SELECT album.id_album, nom_album, date_album, image_album, type_album_val,a.id_artist,a.pseudo_artist from album JOIN compose_album ca on album.id_album = ca.id_album JOIN artist a on a.id_artist = ca.id_artist WHERE album.id_album = :id_album';
            $sqlMusic= 'SELECT c.id_music, lien_music, title_music, time_music, place_album FROM music m JOIN contient c on c.id_music=m.id_music JOIN album a ON a.id_album=c.id_album WHERE a.id_album = :id_album ORDER BY place_album';
            $sqlArtist='SELECT a.id_artist,pseudo_artist FROM artist a JOIN compose_music cm on a.id_artist = cm.id_artist WHERE cm.id_music = :id_music';
            $stmt = $conn->prepare($sqlAlbum);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->execute();
            $resultAlbum = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stmt1 = $conn->prepare($sqlMusic);
            $stmt1->bindParam(':id_album', $id_album);
            $stmt1->execute();
            $resultMusic = $stmt1->fetchAll(PDO::FETCH_ASSOC);

            $Endresult  = array();

            foreach ($resultMusic as $music ) { // On veut récupérer les artistes de chaque musique et les renvoyer sous forme de tableau
                $stmt2 = $conn->prepare($sqlArtist);
                $stmt2->bindParam(':id_music', $music['id_music']);
                $stmt2->execute();
                $resultArtist = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                // $resultMusic[$music]['artist']=$resultArtist;
                $music['artists']=$resultArtist;
                array_push($Endresult,$music);
            }

            
            //on assemble les deux tableaux $resultAlbum et $Endresult dans un tableau $fresult
        
            $fresult['album']=$resultAlbum;
            $fresult['musics']=$Endresult;
            return $fresult;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }

    // Récupère les albums d'un user
    public static function album_user($id_user, $conn) {
        try {
            $sql = 'SELECT album.id_album, nom_album, date_album, image_album, type_album_val,a.id_artist,a.pseudo_artist 
                FROM album 
                JOIN compose_album ca ON album.id_album = ca.id_album 
                JOIN artist a ON a.id_artist = ca.id_artist 
                JOIN aime_album aa ON album.id_album = aa.id_album 
                JOIN users u ON u.id_user = aa.id_user 
                WHERE u.id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }

    // Récupère 5 albums aléatoires 
    public static function album_random($numbers, $conn) {
        try {

            $sql = 'SELECT a.id_album, a.nom_album, a.image_album, ca.id_artist, ar.pseudo_artist 
                FROM album a 
                JOIN compose_album ca ON a.id_album=ca.id_album 
                JOIN artist ar ON ar.id_artist=ca.id_artist 
                ORDER BY RANDOM() LIMIT :numbers';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':numbers', $numbers);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }
}