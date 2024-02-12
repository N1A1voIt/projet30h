<?php
    include("connexion.php");

//createRecord('admin', ['nom_admin' => 'Admin1', 'mdp_admin' => 'password']);
function createRecord($tableName, $data) {
        $dbh = PDOConnect();
        
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        
        $stmt = $dbh->prepare("INSERT INTO $tableName ($columns) VALUES ($values)");
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        $stmt->execute();
        $dbh = null;
    }
    
//$adminRecords = readRecords('admin');
function readRecords($tableName) {
        $dbh = PDOConnect();
    
        $stmt = $dbh->prepare("SELECT * FROM $tableName");
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $dbh = null;
        
        return $result;
    }
    
// deleteRecord('admin', 'nom_admin = "Admin1"');
function deleteRecord($tableName, $condition) {
        $dbh = PDOConnect();
    
        $stmt = $dbh->prepare("DELETE FROM $tableName WHERE $condition");
        $stmt->execute();
    
        $dbh = null;
    }

//updateRecord('admin', ['mdp_admin' => 'newpassword', 'id_admin' => 1], 'nom_admin = "Admin1"');  
    function updateRecord($tableName, $data, $condition, $params = []) {
        $dbh = PDOConnect();
    
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");
    
        $stmt = $dbh->prepare("UPDATE $tableName SET $setClause WHERE $condition");
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        $stmt->execute();
        $dbh = null;
    }
    function connexion($username, $password, $table) {
        $hashedPassword = sha1($password); 
    
        $dbh = PDOConnect();
    
        $stmt = $dbh->prepare("INSERT INTO $table (nom_user, mdp_user) VALUES (:username, :password)");
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->execute();
    
        $dbh = null;
    }
    function login($username, $password, $table) {
        $dbh = PDOConnect();
    
        $stmt = $dbh->prepare("SELECT * FROM $table WHERE nom_user = :username");
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