<?php
include("connexion.php");
    function connexion($username, $password) {
        $hashedPassword = sha1($password); 

        $dbh = PDOConnect();

        $stmt = $dbh->prepare("INSERT INTO 30h_user (nom_user, mdp_user) VALUES (:username, :password)");
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->execute();

        $dbh = null;
    }
    function login($username, $password) {
        $dbh = PDOConnect();

        $stmt = $dbh->prepare("SELECT * FROM 30h_user WHERE nom_user = :username");
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

$usern = $_POST['username'];
$password = $_POST['password'];
if (login($usern, $password) === false){
    $val = array("retValue" => 1);
    echo json_encode($val);
}else{
    $user = login($usern, $password);
    $_SESSION['userInfo'] = array(
        "idUser" => $user["id_admin"]
    );
    echo json_encode(2);
}
?>