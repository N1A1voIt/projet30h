<?php
include("../../function.php");

readRecords('30h_saison');
function debutDuMoisParMois($mois) {
    if ($mois < 1 || $mois > 12) {
        return "Mois invalide";
    }

    $dateDebut = date("Y-m-01", mktime(0, 0, 0, $mois, 1, date("Y")));

    return $dateDebut;
}

$date = $_POST['date'];
$id_cueuilleur = $_POST['id_cueuilleur'];
$id_parcelle = $_POST['id_parcelle'];
$poids = $_POST['poids'];

if(isset($_POST['id_cueillette'])){
    $newdate = date("Y/m/d", strtotime($date));
    $date = str_replace('/','-', $newdate);

    $id_cueillette_to_update = $_POST['id_cueillette'];
    updateRecord('30h_cueillette', ['date' => $date, 'id_cueuilleur' => $id_cueuilleur, 'id_parcelle' => $id_parcelle, 'poids' => $poids], 'id_cueillette = :id_cueillette', ['id_cueillette' => $id_cueillette_to_update]);
}
else{
    $newdate = date("Y/m/d", strtotime($date));
    $date = str_replace('/','-', $newdate);
    createRecord('30h_cueillette', ['date' => $date, 'id_cueuilleur' => $id_cueuilleur, 'id_parcelle' => $id_parcelle, 'poids' => $poids]);
}

?>