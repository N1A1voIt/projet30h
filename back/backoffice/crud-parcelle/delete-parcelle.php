<?php
include("function.php");

$id_parcelle_to_delete = $_POST['id_parcelle'];
deleteRecord('30h_parcelle',  ['id_parcelle' => $id_parcelle_to_delete]);
?>