<?php

class Playlist
{
    // Récupère les infos de toutes les playlists
    public static function info_pla($conn) {
        try {

            if($conn){
                $sql = 'SELECT * FROM playlist';
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

    // Récupère le nom de la playlist à partir de son id
    public static function name_pla($id_playlist, $conn) {
        try {

            $sql = 'SELECT nom_playlist FROM playlist WHERE id_playlist = :id_playlist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_playlist', $id_playlist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['nom_playlist'];
    }
    //Récupère l'id de la playlist depuis son nom : 
    public static function id_pla($nom_playlist, $conn) {
        try {

            $sql = 'SELECT id_playlist FROM playlist WHERE nom_playlist = :nom_playlist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_playlist', $nom_playlist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['id_playlist'];
    }

    // Récupère la date de modification de la playlist à partir de son id
    public static function date_modif_pla($id_playlist, $conn) {
        try {

            $sql = 'SELECT date_modif FROM playlist WHERE id_playlist = :id_playlist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_playlist', $id_playlist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['date_modif'];
    }

    // Récupère la date de creation de la playlist à partir de son id
    public static function date_creation_pla($id_playlist, $conn) {
        try {

            $sql = 'SELECT date_creation FROM playlist WHERE id_playlist = :id_playlist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_playlist', $id_playlist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['date_creation'];
    }
    public static function creer_playlist($nom_playlist, $id_user, $conn) {
        try {
            
            //vérification si la playlist existe déjà :
            $sqlVerif = 'SELECT COUNT(*) FROM playlist WHERE nom_playlist = :nom_playlist AND id_user = :id_user';
            $stmtVerif = $conn->prepare($sqlVerif);
            $stmtVerif->bindParam(':nom_playlist', $nom_playlist);
            $stmtVerif->bindParam(':id_user', $id_user);
            $stmtVerif->execute();
            $resultVerif = $stmtVerif->fetch(PDO::FETCH_ASSOC);
            
            if($resultVerif['count']==0){
                if ($nom_playlist == "Favoris" || $nom_playlist == "favoris"){
                    return "playlist-exist";
                }
                else{
                    //si elle n'existe pas, on l'ajoute :
                    $sql = 'INSERT INTO playlist (nom_playlist, date_creation, id_user, date_modif) VALUES (:nom_playlist, NOW(), :id_user, NOW())';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':nom_playlist', $nom_playlist);
                    $stmt->bindParam(':id_user', $id_user);
                    $stmt->execute();
                    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return true;
                }
            }
            else {
                return "playlist-exist";
            }
            
            
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
            
        }
        
    }
    public static function modifier_playlist($nom_playlist, $id_playlist, $conn) {
        try {
            
            $sql = 'UPDATE playlist SET nom_playlist = :nom_playlist, date_modif = NOW() WHERE id_playlist = :id_playlist';
            //$sql = 'UPDATE playlist SET nom_playlist, date_modif WHERE id_playlist = :id_playlist AND nom_playlist = :nom_playlist AND date_modif = NOW()';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_playlist', $nom_playlist);
            $stmt->bindParam(':id_playlist', $id_playlist);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
    public static function delete_playlist($id_playlist, $conn)
    {
        try
        {
          $request = 'DELETE FROM playlist WHERE id_playlist=:id_playlist';
          $statement = $conn->prepare($request);
          $statement->bindParam(':id_playlist', $id_playlist);
          $statement->execute();
        }
        catch (PDOException $exception)
        {
          error_log('Request error: '.$exception->getMessage());
          return false;
        }
        return true;
      }
      //fonction qui ajoute une musique à une playlist :
        public static function add_music_playlist($id_playlist, $id_music, $conn)
        {
            try
            {
                $sql = 'INSERT INTO playlist_music (id_playlist, id_music, date_modif) VALUES (:id_playlist, :id_music, NOW())';
                $statement = $conn->prepare($sql);
                $statement->bindParam(':id_playlist', $id_playlist);
                $statement->bindParam(':id_music', $id_music);
                $statement->execute();
            }
            catch (PDOException $exception)
            {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            return true;
            }
            //fonction qui supprime une musique d'une playlist :
            public static function delete_music_playlist($id_playlist, $id_music, $conn)
            {
                try
                {
                $request = 'DELETE FROM playlist_music WHERE id_playlist=:id_playlist AND id_music=:id_music';
                $statement = $conn->prepare($request);
                $statement->bindParam(':id_playlist', $id_playlist);
                $statement->bindParam(':id_music', $id_music);
                $statement->execute();
                }
                catch (PDOException $exception)
                {
                error_log('Request error: '.$exception->getMessage());
                return false;
                }
                return true;
            }
            //fonction qui récupère les musiques d'une playlist :
            public static function get_music_playlist($id_playlist, $conn)
            {
                try
                {
                    $request = 'SELECT * FROM playlist_music WHERE id_playlist=:id_playlist';
                    $statement = $conn->prepare($request);
                    $statement->bindParam(':id_playlist', $id_playlist);
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                }
                catch (PDOException $exception)
                {
                    error_log('Request error: '.$exception->getMessage());
                    return false;
                }
                return $result;
            }
            
            

    // Récupère les playlists d'un user
    public static function playlist_user($id_user, $conn) {
        try {
            $sql = 'SELECT id_playlist, nom_playlist, date_modif FROM Playlist WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }
}