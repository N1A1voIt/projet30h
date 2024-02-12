<?php
include("../../function.php");

$depenseRecords = readRecords('30h_depense');
echo json_encode($depenseRecords);
?>