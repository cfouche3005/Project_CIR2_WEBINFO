<?php

class Artist
{
    // Récupère les infos de tous les artistes
    public static function info_art($conn) {
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
}