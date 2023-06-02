<?php
require_once ('database.php');
class Album
{
    // Récupère les infos de tous les albums
    public static function info_alb($conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM album';
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
}