<?php
function PDOConnect(){
    $user = 'root';
    $pass = '';
    $dsn = 'mysql:host=localhost;port=3306;dbname=examfinals3';

    try {
        $dbh = new PDO($dsn, $user, $pass);
        return $dbh;
    } catch (PDOException $e) {
        print "Erreur ! : " . $e->getMessage();
        die();
    }
}
?>
