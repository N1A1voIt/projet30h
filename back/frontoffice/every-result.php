<?php
include_once ('fonction-page-resultats.php');
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

$poids_total_restant = getRestePoidsTotal($date_debut, $date_fin);

/*
 * TODO: getRestePoidsTotal
 * */

$poids_total_cueilli = getPoidsCueilletteTotal($date_debut, $date_fin);
$ca = getCoutRevientRecolte($date_debut, $date_fin);

$ret = array(
    "poids_restant" => $poids_total_restant,
    "poids_cueilli" => $poids_total_cueilli,
    "ca" => $ca,
);
echo json_encode($ret);