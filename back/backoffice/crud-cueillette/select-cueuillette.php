<?php
include("../../function.php");

$parcelleRecords = readRecords('30h_cueillette');
echo json_encode($parcelleRecords);
?>