<?php
include("../../function.php");

$cueilleursRecords = readRecords('30h_salaire_cueilleur');
echo json_encode($cueilleursRecords);
?>