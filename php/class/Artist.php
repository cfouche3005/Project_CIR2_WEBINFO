<?php

class Artist
{
    // Récupère le nom et info de l'artiste à partir de son pseudo
    public static function nom_info_art($pseudo_artist) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT nom_info FROM artist WHERE pseudo_artist = :pseudo_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pseudo_artist', $pseudo_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['nom_info'];
    }

    // Récupère le lien de la bio de l'artiste à partir de son pseudo
    public static function biographie_lien_art($pseudo_artist) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT biographie_lien FROM artist WHERE pseudo_artist = :pseudo_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pseudo_artist', $pseudo_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['biographie_lien'];
    }

    // Récupère le type de l'artiste à partir de son pseudo
    public static function type_art($pseudo_artist) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT type_artist FROM artist WHERE pseudo_artist = :pseudo_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pseudo_artist', $pseudo_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['type_artist'];
    }

    // Récupère la photo de l'artiste à partir de son pseudo
    public static function photo_art($pseudo_artist) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT photo_artist FROM artist WHERE pseudo_artist = :pseudo_artist';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pseudo_artist', $pseudo_artist);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['photo_artist'];
    }
}