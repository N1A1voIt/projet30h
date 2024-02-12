<?php
    session_start();
    require_once ('../../../back/connexion-admin.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (login($username, $password) === false){
        $val = array("retValue" => 1);
        echo json_encode($val);
    }else{
        $user = login($username, $password);
        $_SESSION['userInfo'] = array(
            "idUser" => $user["id_admin"]
        );
        echo json_encode(2);
    }

