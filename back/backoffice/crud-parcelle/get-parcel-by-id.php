<?php
include("../../function.php");

$id_cat_dep=$_POST['id_parcelle'];
$parcelleRecords = readRecordsByid('30h_parcelle','id_parcelle='.$id_cat_dep);
echo json_encode($parcelleRecords);

