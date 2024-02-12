<?php
include("function.php");

$date = $_POST['date'];
$id_cueuilleur = $_POST['id_cueuilleur'];
$id_parcelle = $_POST['id_parcelle'];
$poids = $_POST['poids'];

if(isset($_POST['id_cueillette'])){
    $id_cueillette_to_update = $_POST['id_cueillette'];
    updateRecord('30h_cueillette', ['date' => $date, 'id_cueuilleur' => $id_cueuilleur, 'id_parcelle' => $id_parcelle, 'poids' => $poids], 'id_cueillette = :id_cueillette', ['id_cueillette' => $id_cueillette_to_update]);
}
else{
   createRecord('30h_cueillette', ['date' => $date, 'id_cueuilleur' => $id_cueuilleur, 'id_parcelle' => $id_parcelle, 'poids' => $poids]);
}

?>