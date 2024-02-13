<?php
include("fonction-page-resultats.php");

$id_parcelle = $_POST['id_parcelle'];  
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

$poids_total = getRestePoids($id_parcelle, $date_debut, $date_fin);

$ret = array("poids_reste"=>$poids_total);

echo json_encode($ret);
?>