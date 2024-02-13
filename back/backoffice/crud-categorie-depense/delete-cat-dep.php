<?php
include("../../function.php");

$id_cat_dep_to_delete = $_POST['id_cat_dep'];
deleteRecord('30h_categorie_depense', 'id_cat_dep = '.$id_cat_dep_to_delete);
?>