<?php

class Music
{
    // Récupère le titre de la musique à partir de son id
    public static function title_mus($id_music) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT title_music FROM music WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['title_music'];
    }

    // Récupère le lien de la musique à partir de son id
    public static function link_mus($id_music) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT link_music FROM music WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['link_music'];
    }

    // Récupère le temps de la musique à partir de son id
    public static function time_mus($id_music) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT time_music FROM music WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['time_music'];
    }

    // Récupère la place de la musique dans l'album à partir de son id
    public static function place_album_mus($id_music) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT place_album FROM music WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['place_album'];
    }

    // Récupère le type de la musique à partir de son id
    public static function type_mus($id_music) {
        try {
            $conn = spotvi::connexionBD();
            $sql = 'SELECT type_music FROM music WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['type_music'];
    }
}