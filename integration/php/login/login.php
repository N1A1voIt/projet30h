<?php
    session_start();
    require_once ('../../../back/connexion-admin.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (login($username, $password) === false){
        echo json_encode(1);
    }else{
        $user = login($username, $password);
        $_SESSION['userInfo'] = array(
            "idUser" => $user["idUser"]
        );
        echo json_encode(2);
    }

