<?php

class User
{
    // Récupère les infos de tous les utilisateurs
    public static function info_usr($conn) {
        try {
            
            if($conn){
                $sql = 'SELECT * FROM user';
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

    // Récupère l'id de l'utilisateur à partir de son mail
    public static function id_usr($mail_user, $conn) {
        try {
            
            $sql = 'SELECT id_user FROM user WHERE mail_user = :mail_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $mail_user);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return $result['id_user'];
    }

    // Récupère le nom de l'utilisateur à partir de son identifiant
    public static function nom_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT nom_user FROM user WHERE id_user = :id_user';
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
            
            $sql = 'SELECT prenom_user FROM user WHERE id_user = :id_user';
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
            
            $sql = 'SELECT age_user FROM user WHERE id_user = :id_user';
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
            
            $sql = 'SELECT mdp_user FROM user WHERE id_user = :id_user';
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

    // Récupère le pseudo de l'utilisateur à partir de son identifiant
    public static function pseudo_usr($id_user, $conn) {
        try {
            
            $sql = 'SELECT pseudo_user FROM user WHERE id_user = :id_user';
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
            
            $sql = 'SELECT photo_user FROM user WHERE id_user = :id_user';
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
}