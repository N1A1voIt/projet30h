<?php
function PDOConnect(){
    $user = 'root';
    $pass = 'root';
    $dsn = 'mysql:host=172.10.0.113;port=3306;dbname=examfinals3';

    try {
        $dbh = new PDO($dsn, $user, $pass);
        return $dbh;
    } catch (PDOException $e) {
        print "Erreur ! : " . $e->getMessage();
        die();
    }
}
?>
