<?php
include("connexion.php");
function connexion($adminname, $password) {
    $hashedPassword = sha1($password); 

    $dbh = PDOConnect();

    $stmt = $dbh->prepare("INSERT INTO 30h_admin (nom_admin, mdp_admin) VALUES (:adminname, :password)");
    $stmt->bindValue(":adminname", $adminname);
    $stmt->bindValue(":password", $hashedPassword);
    $stmt->execute();

    $dbh = null;
}
function login($adminname, $password) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT * FROM 30h_admin WHERE nom_admin = :adminname");
    $stmt->bindValue(":adminname", $adminname);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && sha1($password) === $admin['mdp_admin']) {
        $dbh = null;
        return $admin;
    } else {
        $dbh = null;
        return false;
    }
}
?>