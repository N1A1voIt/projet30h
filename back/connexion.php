<?php
function PDOConnect(){
    $user = 'ETU002580';
    $pass = 'XqKFM6BPElmM';
    $dsn = 'mysql:host=172.10.0.113;port=3306;dbname=db_p16_ETU002580';
    try {
        $dbh = new PDO($dsn, $user, $pass);
        return $dbh;
    } catch (PDOException $e) {
        print "Erreur ! : " . $e->getMessage();
        die();
    }
}
?>
