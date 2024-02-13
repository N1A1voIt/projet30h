<?php
include("../../function.php");

$id_cat_dep=$_POST['id_montant_salaire'];
$montant_salaireRecords = readRecordsByid('30h_montant_salaire','id_montant_salaire='.$id_cat_dep);
echo json_encode($montant_salaireRecords);

