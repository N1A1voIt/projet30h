<?php
include("../../function.php");

$cueilleursRecords = readRecords('30h_cueuilleur');
echo json_encode($cueilleursRecords);
?>