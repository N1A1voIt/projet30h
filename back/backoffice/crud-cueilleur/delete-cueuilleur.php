<?php
include("connexion.php");

$id_cueuilleur_to_delete = $_POST['id_cueuilleur'];
deleteRecord('30h_cueuilleur', 'id_cueuilleur = :id_cueuilleur', ['id_cueuilleur' => $id_cueuilleur_to_delete]);
?>