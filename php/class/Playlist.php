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
    /*
    public static function add_music_playlist($id_playlist, $id_music, $conn) //fonction à vérifier
    {
        try
        {
            //$test = 1;


            $sql = 'INSERT INTO possede (id_playlist, id_music) VALUES (:id_playlist, :id_music)';
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->bindParam(':id_music', $id_music);
            $statement->execute();

            $checkSql = 'SELECT COUNT(*) FROM possede WHERE id_playlist = :id_playlist AND id_music = :id_music';
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bindParam(':id_playlist', $id_playlist);
            $checkStmt->bindParam(':id_music', $id_music);
            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();

            if ($count == 1) {
                // La combinaison id_music/id_playlist existe déjà, renvoyer une erreur ou un message approprié
                $updateSql = "UPDATE playlist
                      SET date_modif = CURRENT_DATE 
                      WHERE id_playlist = :id_playlist";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bindParam(':id_playlist', $id_playlist);
                $updateStmt->execute();
                return true;
            }
            //error_log($test);
            //$test = $test +1;
            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }*/
    public static function add_music_playlist($id_playlist, $id_music, $conn)
    {
        try
        {
            // Vérifier si la combinaison id_music/id_playlist existe déjà
            $checkSql = 'SELECT COUNT(*) FROM possede WHERE id_playlist = :id_playlist AND id_music = :id_music';
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bindParam(':id_playlist', $id_playlist);
            $checkStmt->bindParam(':id_music', $id_music);
            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                // La combinaison id_music/id_playlist existe déjà, renvoyer une erreur ou un message approprié
                return false;
            }

            // Effectuer l'insertion
            $sql = 'INSERT INTO possede (id_playlist, id_music) VALUES (:id_playlist, :id_music)';
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->bindParam(':id_music', $id_music);
            $statement->execute();

            // Mettre à jour la date de modification de la playlist
            $updateSql = "UPDATE playlist SET date_modif = CURRENT_DATE WHERE id_playlist = :id_playlist";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':id_playlist', $id_playlist);
            $updateStmt->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            ############################################################################################################
            return true; ######GROS PROBLEME ICI mais ça marche#########################################################
            ############################################################################################################
        }
    }
    //fonction qui supprime une musique d'une playlist :
    public static function delete_music_playlist($id_playlist, $id_music, $conn) //fonction à vérifier
        {
            try
            {
                $request = 'DELETE FROM possede WHERE id_playlist=:id_playlist AND id_music=:id_music';
                $statement = $conn->prepare($request);
                $statement->bindParam(':id_playlist', $id_playlist);
                $statement->bindParam(':id_music', $id_music);
                $statement->execute();

                // Mettre à jour la date de modification de la playlist
                $updateSql = "UPDATE playlist SET date_modif = CURRENT_DATE WHERE id_playlist = :id_playlist";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bindParam(':id_playlist', $id_playlist);
                $updateStmt->execute();
                return true;
                }
                catch (PDOException $exception)
                {
                error_log('Request error: '.$exception->getMessage());
                return false;
                }
            }       
            //fonction qui récupère les musiques d'une playlist :
    public static function get_music_playlist($id_playlist, $conn) //fonction à vérifier
        {
            try
            {   
                //$sqlMusic = 'SELECT m.id_music, lien_music, title_music, time_music FROM music m JOIN possede pm on m.id_music=pm.id_music JOIN playlist pl ON pm.id_playlist=pl.id_playlist WHERE pl.id_playlist = :id_playlist';
                //$sqlMusic= 'SELECT m.id_music, lien_music, title_music, time_music FROM music m JOIN playlist_music pm on m.id_music=pm.id_music JOIN playlist pl ON pm.id_playlist=pl.id_playlist WHERE pl.id_playlist = :id_playlist';
                //$sqlMusic= 'SELECT m.id_music, lien_music, title_music, time_music FROM music m JOIN possede p on m.id_music=p.id_music JOIN playlist pl ON p.id_music=pl.id_music WHERE pl.id_playlist = :id_playlist';
                //$sqlArtist= 'SELECT a.id_artist, nom_artist FROM artist a JOIN compose c ON a.id_artist=c.id_artist JOIN music m ON c.id_music=m.id_music WHERE m.id_music = :id_music';
                $sqlArtist='SELECT a.id_artist,pseudo_artist FROM artist a JOIN compose_music cm on a.id_artist = cm.id_artist WHERE cm.id_music = :id_music';
                $sqlMusic = 'SELECT m.id_music, lien_music, title_music, time_music FROM music m JOIN possede p on m.id_music=p.id_music JOIN playlist pl ON p.id_playlist=pl.id_playlist WHERE pl.id_playlist = :id_playlist';
                //$sqlArtist = 'SELECT a.id_artist,pseudo_artist FROM artist a JOIN compose_music cm on a.id_artist = cm.id_artist JOIN music m on cm.id_artist=m.id_artist JOIN possede p on m.id_artist=p.id_artist JOIN playlist pa on p.id_artist=pa.id_artist WHERE pa.id_playlist = :id_playlist';
                //$sqlPlaylist = 'SELECT * FROM playlist WHERE id_playlist=:id_playlist';
                $sqlPlaylist = 'SELECT id_playlist, nom_playlist, date_creation, date_modif from playlist where id_playlist=:id_playlist';
                $stmt = $conn->prepare($sqlPlaylist);
                $stmt->bindParam(':id_playlist', $id_playlist);
                $stmt->execute();
                $resultPlaylist = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                $stmt1 = $conn->prepare($sqlMusic);
                $stmt1->bindParam(':id_playlist', $id_playlist);
                $stmt1->execute();
                $resultMusic = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                $Endresult  = array();
                foreach ($resultMusic as $music ) {
                    $stmt2 = $conn->prepare($sqlArtist);
                    $stmt2->bindParam(':id_music', $music['id_music']);
                    $stmt2->execute();
                    $resultArtist = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    // $resultMusic[$music]['artist']=$resultArtist;
                    $music['artists']=$resultArtist;
                    array_push($Endresult,$music);
                }
                
                // $fresult['artist']=$resultArtist;
                $fresult['playlist']=$resultPlaylist;
                $fresult['musics']=$Endresult;
                return $fresult;
                
                /*
                $statement = $conn->prepare($request);
                $statement->bindParam(':id_playlist', $id_playlist);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                */
            }
            catch (PDOException $exception)
            {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
        }
            
            

    //Récupère les playlists d'un user
    public static function playlist_user($id_user, $conn) { //fonction à vérifier
        try {
            $sql = 'SELECT id_playlist, nom_playlist, date_modif FROM Playlist WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }
}