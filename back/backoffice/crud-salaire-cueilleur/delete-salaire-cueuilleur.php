<?php
include("../../function.php");

$id_cueuilleur_to_delete = $_POST['id_salaire_cueilleur'];
deleteRecord('30h_salaire_cueilleur', 'id_salaire_cueilleur = '.$id_cueuilleur_to_delete);
?>