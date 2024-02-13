<?php
include_once('function.php');

$nom_the = $_POST['nom_the'];
$occupation = $_POST['occupation'];
$rendement = $_POST['rendement'];
$price = $_POST['price'];

if (isset($_POST['id_the'])){
    updateRecord('30h_the', ['nom_the' => $nom_the, 'occupation' => $occupation, 'rendement' => $rendement], 'id_the = :id_the', ['id_the' => $_POST['id_the']]);
}else{
    createRecord('30h_the', ['nom_the' => $nom_the, 'occupation' => $occupation, 'rendement' => $rendement,'price'=>$price]);
}



?>