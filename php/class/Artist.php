<?php

class Artist
{
    // Récupère les infos de tous les artistes
    public static function all_art($conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM artist';
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }

    // Récupère l'id d'un artiste' à partir de son pseudo
    public static function id_art($pseudo_artist, $conn) {
        try {
            
            $sql = 'SELECT id_artist FROM artist WHERE pseudo_artist = :pseudo_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pseudo_artist', $pseudo_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['id_artist'];
    }

    // Récupère le nom et info de l'artiste à partir de son id
    public static function name_info_art($id_artist, $conn) {
        try {
            
            $sql = 'SELECT name_info FROM artist WHERE id_artist = :id_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_artist', $id_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['name_info'];
    }

    // Récupère le lien de la bio de l'artiste à partir de son id
    public static function biographie_lien_art($id_artist, $conn) {
        try {
            
            $sql = 'SELECT biographie_lien FROM artist WHERE id_artist = :id_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_artist', $id_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['biographie_lien'];
    }

    // Récupère le type de l'artiste à partir de son id
    public static function type_art($id_artist, $conn) {
        try {
            
            $sql = 'SELECT type_artist_val FROM artist_appartient_type WHERE id_artist = :id_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_artist', $id_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['type_artist_val'];
    }

    // Récupère la photo de l'artiste à partir de son id
    public static function photo_art($id_artist, $conn) {
        try {
            
            $sql = 'SELECT photo_artist FROM artist WHERE id_artist = :id_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_artist', $id_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['photo_artist'];
    }
    //fonction qui récupère les informations de l'artiste, les albums dans lequel il est ainsi que 6 musiques produites par l'artiste :
    public static function info_artiste($id_artist, $conn) {
        try {

            //requete qui n'affichait qu'une seule musique, à vérifier si c'est toujours le cas
            $sqlMusic = 'SELECT title_music from music m join compose_music cm on m.id_music=cm.id_music join artist a on cm.id_artist=a.id_artist where a.id_artist=:id_artist limit 6';
            
            //requete théorique mais surement fonctionnelle
            $sqlAlbum = 'SELECT * from album a join compose_album ca on a.id_album=ca.id_album join artist ar on ca.id_artist=ar.id_artist where ar.id_artist=:id_artist';
            $stmt = $conn->prepare($sqlAlbum);
            $stmt->bindParam(':id_artist', $id_artist);
            $stmt->execute();
            $resultAlbum = $stmt->fetchAll(PDO::FETCH_ASSOC);
           // requete pour récupérer les informations de l'artist --> fonctionnelle
            $sqlArtist = 'SELECT * from artist where id_artist=:id_artist';
            $stmt1 = $conn->prepare($sqlArtist);
            $stmt1->bindParam(':id_artist', $id_artist);
            $stmt1->execute();
            $resultArtist = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            
            $EndResult = array();
            foreach ($resultAlbum as $album) //potentielles erreurs dans le foreach mais normalement ça devrait marcher
            {
                $stmt2 = $conn->prepare($sqlMusic);
                $stmt2->bindParam(':id_album', $album['id_album']);
                $stmt2->execute();
                $resultMusic = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $album['musics']=$resultMusic; //potentielle erreur
                array_push($Endresult,$album);
            }
            return $EndResult;
           
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        
    }
}