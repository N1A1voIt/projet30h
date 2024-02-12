<?php
include_once('function.php');

$id_the_to_update = $_POST['id_the'];
$updated_nom_the = $_POST['updated_nom_the'];
$updated_occupation = $_POST['updated_occupation'];
$updated_rendement = $_POST['updated_rendement'];

updateRecord('30h_the', ['nom_the' => $updated_nom_the, 'occupation' => $updated_occupation, 'rendement' => $updated_rendement], 'id_the = :id_the', ['id_the' => $id_the_to_update]);


?>