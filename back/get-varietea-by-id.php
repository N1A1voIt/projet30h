<?php
include("function.php");

$id_cat_dep=$_POST['id_the'];
$parcelleRecords = readRecordsByid('30h_the','id_the='.$id_cat_dep);
echo json_encode($parcelleRecords);

