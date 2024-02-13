<?php
include("../../function.php");

$id_cat_dep=$_POST['id_cat_dep'];
$parcelleRecords = readRecordsByid('30h_categorie_depense','id_cat_dep='.$id_cat_dep);
echo json_encode($parcelleRecords);
?>