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
    public static function creer_playlist($nom_playlist) {
        try {
            $conn = dbConnect();
            $sql = 'INSERT INTO playlist (nom_playlist) VALUES (:nom_playlist)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_playlist', $nom_playlist);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
}