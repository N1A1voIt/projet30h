<?php

require_once ('function.php');

function getCueuilleurParcelleData() {
    $cueuilleurParcelleRecords = readRecords('30h_cueuilleur');
    $parcelleRecords = readRecords('30h_parcelle');

    $resultArray3 = array();

    foreach ($parcelleRecords as $parcelle) {
        $resultArray3[]['id_parcelle'] = $parcelle['id_parcelle'];
    }

    $resultArray = array(
        'cueilleur' => $cueuilleurParcelleRecords,
        'id_parcelle' => $resultArray3
    );
    return $resultArray;
}

echo json_encode(getCueuilleurParcelleData());

?>