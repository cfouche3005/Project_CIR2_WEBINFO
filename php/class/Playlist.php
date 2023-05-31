<?php

class Playlist
{
    // Récupère le nom de la playlist à partir de son id
    public static function name_pla($id_playlist) {
        try {
            $conn = spotvi::connexionBD();
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

    // Récupère la date de modification de la playlist à partir de son id
    public static function date_modif_pla($id_playlist) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function date_creation_pla($id_playlist) {
        try {
            $conn = spotvi::connexionBD();
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
}