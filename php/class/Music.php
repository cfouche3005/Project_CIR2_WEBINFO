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
    public static function rechercherMusique($conn, $recherche) {
        try {
            $sql = 'SELECT * FROM music WHERE title_music LIKE :recherche';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':recherche', $recherche);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }
    public static function rechercherMusiqueGenre($conn, $recherche) {
        try {
            $sql = 'SELECT * FROM music WHERE id_music IN (SELECT id_music FROM music_appartient_genre WHERE genre_music_val LIKE :recherche)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':recherche', $recherche);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }
    public static function rechercherMusiqueArtiste($conn, $recherche) {
        try {
            $sql = 'SELECT * FROM music WHERE id_music IN (SELECT id_music FROM music_appartient_artiste WHERE id_artiste IN (SELECT id_artiste FROM artiste WHERE nom_artiste LIKE :recherche))';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':recherche', $recherche);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }

    //vérifie si une musique est dans les favoris d'un user spécifique
    public static function verif_music_like($id_music, $id_user, $conn){
        try {
            $sql = 'SELECT COUNT(*) FROM possede p
                INNER JOIN playlist pl ON p.id_playlist = pl.id_playlist 
                WHERE pl.nom_playlist = :nom_playlist 
                AND p.id_music = :id_music
                AND pl.id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_playlist', 'Favoris');
            $stmt->bindParam(':id_music', $id_music);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result['count']>=1){
                return true;
            }
            else return false;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }

    //ajoute une musique dans les favoris d'un user spécifique
    public static function ajout_music_like($id_music, $id_user, $conn){
        try {
            $sql = 'INSERT INTO possede (id_music, id_playlist) VALUES (:id_music, (SELECT id_playlist FROM playlist WHERE nom_playlist = :nom_playlist AND id_user = :id_user))';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_playlist', 'Favoris');
            $stmt->bindParam(':id_music', $id_music);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();

            $updateSql = 'UPDATE playlist 
                      SET date_modif = CURRENT_DATE 
                      WHERE nom_playlist = :nom_playlist 
                      AND id_user = :id_user';
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':nom_playlist', 'Favoris');
            $updateStmt->bindParam(':id_user', $id_user);
            $updateStmt->execute();

            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }

    //supprime une musique dans les favoris d'un user spécifique
    public static function delete_music_like($id_music, $id_user, $conn){
        try {
            $sql = 'DELETE FROM possede WHERE id_music = :id_music AND id_playlist = (SELECT id_playlist FROM playlist WHERE nom_playlist = :nom_playlist AND id_user = :id_user)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_playlist', 'Favoris');
            $stmt->bindParam(':id_music', $id_music);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();

            $updateSql = 'UPDATE playlist 
                      SET date_modif = CURRENT_DATE 
                      WHERE nom_playlist = :nom_playlist 
                      AND id_user = :id_user';
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':nom_playlist', 'Favoris');
            $updateStmt->bindParam(':id_user', $id_user);
            $updateStmt->execute();
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
}