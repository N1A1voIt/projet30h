<?php
include_once('function.php');

$nom_the = $_POST['nom_the'];
$occupation = $_POST['occupation'];
$rendement = $_POST['rendement'];
$price = $_POST['price'];

createRecord('30h_the', ['nom_the' => $nom_the, 'occupation' => $occupation, 'rendement' => $rendement,'price'=>$price]);
?>