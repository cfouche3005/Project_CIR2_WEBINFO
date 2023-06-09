<?php

class Users
{
    // Récupère les infos de tous les utilisateurs
    public static function info_usr($conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM users';
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
    // Récupérer les infos d'un utilisateur à partir de son id
    public static function info_usr_by_id($id_user, $conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM users where id_user = :id_user';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_user', $id_user);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result;
    }

    // Récupère l'id de l'utilisateur à partir de son mail
    public static function id_usr($mail_user, $conn) {
        try {
            
            $sql = 'SELECT id_user FROM users WHERE mail_user = :mail_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mail_user', $mail_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['id_user'];
    }
    // Récupère le mail de l'utilisateur à partir de son id
    public static function mail_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT mail_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['mail_user'];
    }

    // Récupère le nom de l'utilisateur à partir de son identifiant
    public static function nom_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT nom_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['nom_user'];
    }

    // Récupère le prénom de l'utilisateur à partir de son identifiant
    public static function prenom_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT prenom_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['prenom_user'];
    }

    // Récupère l'âge' de l'utilisateur à partir de son identifiant
    public static function age_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT age_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['age_user'];
    }

    // Récupère le mdp de l'utilisateur à partir de son identifiant
    public static function mdp_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT mdp_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['mdp_user'];
    }
    // Fonction qui permet de se connecter 
    public static function login_usr($mail_user, $mdp_user, $conn) {
        try {
            $mail_exist= 'SELECT COUNT(*) FROM users WHERE mail_user = :mail_user';
            $stmt = $conn->prepare($mail_exist);
            $stmt->bindParam(':mail_user', $mail_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['count'] == 1) {

                        //récupère le mp crypté present ds la base de donnée selon l'email 
                    $request = 'SELECT mdp_user from users where mail_user = :mail_user'; 
                    $statement = $conn->prepare($request);
                    $statement->bindParam(':mail_user',$mail_user);
                    $statement->execute();
                    $mp_crypt_bd = $statement->fetch(PDO::FETCH_ASSOC);
            
                    //verifie si mp entrer est mp crypt de la bd
                    $checkMp = password_verify($mdp_user,$mp_crypt_bd['mdp_user']);   //attention verify prend que string
                    if($checkMp){
                        $sql = 'SELECT * FROM users WHERE mail_user = :mail_user';
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':mail_user', $mail_user);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $result;

                    }
                    else {
                        return false;
                    }
            }
            else  {
                return false;
            }
        }
            
        catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        
    }

    // Récupère le pseudo de l'utilisateur à partir de son identifiant
    public static function pseudo_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT pseudo_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['pseudo_user'];
    }

    // Récupère le photo de l'utilisateur à partir de son identifiant
    public static function photo_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT photo_user FROM users WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['photo_user'];
    }
    //Fonction qui permet de se créer un compte 
    public static function ajout_usr($mail_user, $nom_user, $prenom_user, $date_naissance, $mdp_user, $pseudo_user, $photo_user, $conn) {
        try {
            
            $sql = 'INSERT INTO users (mail_user, nom_user, prenom_user, date_naissance, mdp_user, pseudo_user, photo_user, id_user) VALUES (:mail_user, :nom_user, :prenom_user, :date_naissance, :mdp_user, :pseudo_user, :photo_user, DEFAULT)';
            
            //vérification si le mail n'existe pas déjà 
            $mail_exist= 'SELECT COUNT(*) FROM users WHERE mail_user = :mail_user';
            $stmt = $conn->prepare($mail_exist);
            $stmt->bindParam(':mail_user', $mail_user);
            $stmt->execute();
            $resultMail = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resultMail['count']>=1){
                return "mail-exist";
            }
            else{
                $stmt4 = $conn->prepare($sql);
                $stmt4->bindParam(':mail_user', $mail_user);
                $stmt4->bindParam(':nom_user', $nom_user);
                $stmt4->bindParam(':prenom_user', $prenom_user);
                $stmt4->bindParam(':date_naissance', $date_naissance);
                $mdp_user= password_hash($mdp_user, PASSWORD_BCRYPT);
                $stmt4->bindParam(':mdp_user', $mdp_user);
                $stmt4->bindParam(':pseudo_user', $pseudo_user);
                $stmt4->bindParam(':photo_user', $photo_user);
                $stmt4->execute();
                $result = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                //on crée une playlist par défaut " Favoris" pour l'utilisateur :
                $playlistFav = 'INSERT INTO playlist (nom_playlist, date_creation, date_modif, id_user) VALUES (:nom_playlist, NOW(), NOW(), (SELECT id_user FROM users WHERE mail_user = :mail_user))';
                $stmt2 = $conn->prepare($playlistFav);
                $nom_playlist = "Favoris";
                $stmt2->bindParam(':nom_playlist', $nom_playlist);
                $stmt2->bindParam(':mail_user', $mail_user);
                $stmt2->execute();
                
            }
        
        }catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    return true;
    }
    //Fonction qui permet de modifier les informations de son compte
    public static function modifier_usr($id_user, $mail_user, $nom_user, $prenom_user, $date_naissance, $mdp_user, $pseudo_user, $conn) {
        try {
            
            $sql = 'UPDATE users SET mail_user = :mail_user, nom_user = :nom_user, prenom_user = :prenom_user, date_naissance = :date_naissance, mdp_user = :mdp_user, pseudo_user = :pseudo_user WHERE id_user = :id_user';
            
            //$sql = 'UPDATE playlist SET nom_playlist = :nom_playlist, date_modif = NOW() WHERE id_playlist = :id_playlist';
            //$sql = 'UPDATE playlist SET nom_playlist, date_modif WHERE id_playlist = :id_playlist AND nom_playlist = :nom_playlist AND date_modif = NOW()';
            //vérification si le mail n'existe pas déjà 
            $mail_exist= 'SELECT COUNT(*) FROM users WHERE mail_user = :mail_user';
            $stmt = $conn->prepare($mail_exist);
            $stmt->bindParam(':mail_user', $mail_user);
            $stmt->execute();
            $resultMail = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resultMail['count']>=1){
                return "mail-exist";
            }
            else {
                $stmt4 = $conn->prepare($sql);
                $stmt4->bindParam(':mail_user', $mail_user);
                $stmt4->bindParam(':nom_user', $nom_user);
                $stmt4->bindParam(':prenom_user', $prenom_user);
                $stmt4->bindParam(':date_naissance', $date_naissance);
                $mdp_user= password_hash($mdp_user, PASSWORD_BCRYPT);
                $stmt4->bindParam(':mdp_user', $mdp_user);
                $stmt4->bindParam(':pseudo_user', $pseudo_user);
                $stmt4->bindParam(':id_user', $id_user);
                $stmt4->execute();
                $result = $stmt4->fetchAll(PDO::FETCH_ASSOC);
            }
            return Users::info_usr_by_id($id_user, $conn);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
    //Fonction qui permet de modifier les informations de son compte sans modifier le mot de passe
    public static function modifier_usr_sans_mdp($id_user, $mail_user, $nom_user, $prenom_user, $date_naissance, $pseudo_user, $conn) {
        try {
            
            $sql = 'UPDATE users SET mail_user = :mail_user, nom_user = :nom_user, prenom_user = :prenom_user, date_naissance = :date_naissance, pseudo_user = :pseudo_user WHERE id_user = :id_user';
            
            //$sql = 'UPDATE playlist SET nom_playlist = :nom_playlist, date_modif = NOW() WHERE id_playlist = :id_playlist';
            //$sql = 'UPDATE playlist SET nom_playlist, date_modif WHERE id_playlist = :id_playlist AND nom_playlist = :nom_playlist AND date_modif = NOW()';
            $mail_exist= 'SELECT COUNT(*) FROM users WHERE mail_user = :mail_user';
            $stmt = $conn->prepare($mail_exist);
            $stmt->bindParam(':mail_user', $mail_user);
            $stmt->execute();
            $resultMail = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resultMail['count']>=1){
                return "mail-exist";
            }
            else{
                $stmt4 = $conn->prepare($sql);
                $stmt4->bindParam(':mail_user', $mail_user);
                $stmt4->bindParam(':nom_user', $nom_user);
                $stmt4->bindParam(':prenom_user', $prenom_user);
                $stmt4->bindParam(':date_naissance', $date_naissance);
                $stmt4->bindParam(':pseudo_user', $pseudo_user);
                $stmt4->bindParam(':id_user', $id_user);
                $stmt4->execute();
                $result = $stmt4->fetchAll(PDO::FETCH_ASSOC);
            }
            return Users::info_usr_by_id($id_user, $conn);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
    //Fonction qui permet de supprimer un utilisateur
    public static function delete_usr($id_user, $conn)
    {
        try
        {
          $request = 'DELETE FROM users WHERE id_user=:id_user';
          $statement = $conn->prepare($request);
          $statement->bindParam(':id_user', $id_user);
          $statement->execute();
        }
        catch (PDOException $exception)
        {
          error_log('Request error: '.$exception->getMessage());
          return false;
        }
        return true;
      }

      //fonction qui permet de savoir quelles playlists un user a créé à partir de son id :
    /*
        public static function playlist_user($id_user, $conn) {
            try {
                
                $sql = 'SELECT id_playlist FROM playlist WHERE id_user = :id_user';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_user', $id_user);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $id_playlist = array();
                foreach ($result as $key => $value) {
                    $id_playlist[] = $value['id_playlist'];
                }
            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }
            return $id_playlist;
      
      }*/
    //Fonction qui permet de savoir quelles albums un utilisateur à aimé afin de pouvoir l'ajouter à sa bibliothèque
    public static function usr_aime_album($id_user, $id_album, $conn) {
        try {
            $sql = 'INSERT INTO aime_album (id_album, id_user) VALUES (:id_album, :id_user)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }

    // Fonction qui permet de savoir si un utilisateur a déjà aimé un album
        public static function usr_aime_album_verif($id_user, $id_album, $conn) {
        try {
            $sql= 'SELECT COUNT(*) FROM aime_album WHERE id_user = :id_user AND id_album = :id_album';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['count']>=1){
                return true;
            }
            else {
                return false;
            }
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
    //Fonction qui permet d'enlever un album de la liste des albums aimés par un utilisateur
    public static function usr_aime_album_delete($id_user, $id_album, $conn) {
        try {
            $sql = 'DELETE FROM aime_album WHERE id_album = :id_album AND id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_album', $id_album);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    }
}