<?php
include("fonction-page-resultats.php");

$id_parcelle = $_POST['id_parcelle'];  
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

//cout de revinet par recolte
$poids_total = getCoutRevientRecolte($date_debut, $date_fin);

//cout de revinet par rendement
$poids_total2 = getCoutRevientRendement($date_debut, $date_fin);

$ret = array("coutRevientRecolte" => $poids_total,
    "coutRevientRendment" => $poids_total2);

echo json_encode($ret);

?>