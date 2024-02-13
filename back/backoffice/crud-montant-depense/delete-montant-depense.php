<?php
include("../../function.php");

$id_montant_salaire_to_delete = $_POST['id_montant_salaire'];
deleteRecord('30h_montant_salaire', 'id_montant_salaire = :id_montant_salaire', ['id_montant_salaire' => $id_montant_salaire_to_delete]);
?>