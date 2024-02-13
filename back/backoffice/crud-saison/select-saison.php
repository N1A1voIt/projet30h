<?php
include("../../function.php");

$saisonRecords = readRecords('30h_saison');
echo json_encode($saisonRecords);
?>