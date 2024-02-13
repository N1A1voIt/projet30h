<?php
include("../../function.php");

$id_cat_dep=$_POST['id_salaire_cueilleur'];
$parcelleRecords = readRecordsByid('30h_salaire_cueilleur','id_salaire_cueilleur='.$id_cat_dep);
echo json_encode($parcelleRecords);

