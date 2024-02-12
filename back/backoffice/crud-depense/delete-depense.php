<?php
include("function.php");

$id_depense_to_delete = $_POST['id_depense'];
deleteRecord('30h_depense', 'id_depense = :id_depense', ['id_depense' => $id_depense_to_delete]);
?>