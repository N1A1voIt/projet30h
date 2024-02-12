<?php
include("function.php");

$date = $_POST['updated_date'];
$id_cueuilleur = $_POST['updated_id_cueuilleur'];
$id_parcelle = $_POST['updated_id_parcelle'];
$poids = $_POST['updated_poids'];

if(isset($_POST['id_cueillette'])){
    $id_cueillette_to_update = $_POST['id_cueillette'];
    updateRecord('30h_cueillette', ['date' => $date, 'id_cueuilleur' => $id_cueuilleur, 'id_parcelle' => $id_parcelle, 'poids' => $poids], 'id_cueillette = :id_cueillette', ['id_cueillette' => $id_cueillette_to_update]);
}
else{
   createRecord('30h_cueillette', ['date' => $date, 'id_cueuilleur' => $id_cueuilleur, 'id_parcelle' => $id_parcelle, 'poids' => $poids]);
}

?>