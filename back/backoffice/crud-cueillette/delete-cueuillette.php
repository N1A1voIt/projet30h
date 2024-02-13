<?php
include("../../function.php");

$id_cueillette_to_delete = $_POST['id_cueillette'];
deleteRecord('30h_cueillette', 'id_cueillette = '.$id_cueillette_to_delete);
?>