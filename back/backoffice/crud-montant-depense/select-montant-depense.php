<?php
include("../../function.php");

$depenseRecords = readRecords('30h_montant_salaire');
echo json_encode($depenseRecords);

?>