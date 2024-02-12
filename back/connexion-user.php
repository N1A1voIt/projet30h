<?php
include("connexion.php");
    function connexion($username, $password) {
        $hashedPassword = sha1($password); 

        $dbh = PDOConnect();

        $stmt = $dbh->prepare("INSERT INTO user (nom_user, mdp_user) VALUES (:username, :password)");
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->execute();

        $dbh = null;
    }
    function login($username, $password) {
        $dbh = PDOConnect();

        $stmt = $dbh->prepare("SELECT * FROM user WHERE nom_user = :username");
        $stmt->bindValue(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && sha1($password) === $user['mdp_user']) {
            $dbh = null;
            return $user;
        } else {
            $dbh = null;
            return false;
        }
    }
?>