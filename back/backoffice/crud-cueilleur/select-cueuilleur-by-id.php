<?php

include("../../function.php");

$id_cat_dep = $_POST['id_cueuilleur'];
$parcelleRecords = readRecordsByid('30h_cueuilleur', 'id_cueuilleur=' . $id_cat_dep);
echo json_encode($parcelleRecords);

