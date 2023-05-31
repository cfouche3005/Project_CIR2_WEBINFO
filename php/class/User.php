<?php

class User
{
    // Récupère l'id de l'utilisateur à partir de son mail
    public static function id($mail_user) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function nom($id_user) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function prenom($id_user) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function age($id_user) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function mdp($id_user) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function pseudo($id_user) {
        try {
            $conn = spotvi::connexionBD();
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
    public static function photo($id_user) {
        try {
            $conn = spotvi::connexionBD();
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