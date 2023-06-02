<?php

class Music
{
    // Récupère les infos de toutes les musiques
    public static function info_mus($conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM music';
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

    // Récupère l'id d'une musique à partir de son titre
    public static function id_mus($title_music, $conn) {
        try {
            
            $sql = 'SELECT id_music FROM music WHERE title_music = :title_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title_music', $title_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['id_music'];
    }

    // Récupère le titre de la musique à partir de son id
    public static function title_mus($id_music, $conn) {
        try {
            
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
    public static function link_mus($id_music, $conn) {
        try {
            
            $sql = 'SELECT lien_music FROM music WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['lien_music'];
    }

    // Récupère le temps de la musique à partir de son id
    public static function time_mus($id_music, $conn) {
        try {
            
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
    public static function place_album_mus($id_music, $conn) {
        try {
            
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

    // Récupère le genre de la musique à partir de son id
    public static function genre_mus($id_music, $conn) {
        try {
            
            $sql = 'SELECT genre_music_val FROM music_appartient_genre WHERE id_music = :id_music';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_music', $id_music);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['genre_music_val'];
    }
}