<?php

include_once('function.php');

function getCueuilleurParcelleData() {
    $cueuilleurParcelleRecords = readRecords('30h_cueuilleur');
    $parcelleRecords = readRecords('30h_parcelle');

    $resultArray1 = array();
    $resultArray2 = array();
    $resultArray3 = array();

    foreach ($cueuilleurParcelleRecords as $cueuilleurRecord) {
        $resultArray1[] = $cueuilleurRecord['id_cueuilleur'];
        $resultArray2[] = $cueuilleurRecord['nom'];
    }

    foreach ($parcelleRecords as $parcelle) {
        $resultArray3[] = $parcelle['id_parcelle'];
    }

    $resultArray = array(
        'id_cueuilleur' => $resultArray1,
        'nom_cueuilleur' => $resultArray2,
        'id_parcelle' => $resultArray3
    );
    return $resultArray;
}

?>