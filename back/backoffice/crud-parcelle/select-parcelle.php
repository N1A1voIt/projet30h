<?php
include("../../function.php");

$parcelleRecords = readRecords('30h_parcelle');
echo json_encode($parcelleRecords);
?>