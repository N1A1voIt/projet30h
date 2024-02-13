<?php

include("../../function.php");

$parcelleRecords = readRecords('30h_categorie_depense');

echo json_encode($parcelleRecords);
