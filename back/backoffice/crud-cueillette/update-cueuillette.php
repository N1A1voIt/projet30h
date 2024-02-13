<?php

require_once ("../../function.php");
include_once("../../frontoffice/fonction-page-resultats.php");

function extraireMois($date) {
    $daty = str_replace('/','-', $date);
    $timestamp = strtotime($daty);
    $mois = date('m', $timestamp);

    return $mois;
}


function debutDuMoisParMois($mois) {
    if ($mois < 1 || $mois > 12) {
        return "Mois invalide";
    }

    $dateDebut = date("Y-m-01", mktime(0, 0, 0, $mois, 1, date("Y")));

    return $dateDebut;
}

function lastMonthRegenerate($date){
    $mois = extraireMois($date);
    $saison = readRecords('30h_saison');
    $a = 0;
    foreach($saison as $sea){
        if($sea['valide'] == true && $sea['id_saison'] <= $mois){
            $a = $sea['id_saison'];
        }
    }
    return $a;
}


$date = $_POST['date'];
$id_cueuilleur = $_POST['id_cueuilleur'];
$id_parcelle = $_POST['id_parcelle'];
$poids = $_POST['poids'];

if(getRestePoids($id_parcelle, debutDuMoisParMois(lastMonthRegenerate($date)), $date) >= $poids){
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
}
else{
    echo("le poids recolte depasse celle du poids du parcelle");
}
?>