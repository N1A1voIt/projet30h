<?php
include("fonction-page-resultats.php");

$id_parcelle = $_POST['id_parcelle'];  
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

$poids_total = getPoidsCueillette($id_parcelle, $date_debut, $date_fin);

?>