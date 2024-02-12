<?php
$id_parcelle = $_POST['id_parcelle'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

$poids_total_restant = getRestePoids($id_parcelle, $date_debut, $date_fin);
$poids_total_cueilli = getPoidsCueillette($id_parcelle, $date_debut, $date_fin);
$ca = getCoutRevientRecolte($date_debut, $date_fin);

$ret = array(
    "poids_restant" => $poids_total_restant,
    "poids_cueilli" => $poids_total_cueilli,
    "ca" => $ca,
);
echo json_encode($ret);