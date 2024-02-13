<?php
include("../../function.php");


if(isset($_POST['id_cat_dep'])){
    $id_cat_dep_to_update = $_POST['id_cat_dep'];
    $updated_nom_cat_dep = $_POST['nom_cat_dep'];

    updateRecord('30h_categorie_depense', ['nom_cat_dep' => $updated_nom_cat_dep], 'id_cat_dep = :id_cat_dep', ['id_cat_dep' => $id_cat_dep_to_update]);
}
else{
    $nom_cat_dep = $_POST['nom_cat_dep'];
    createRecord('30h_categorie_depense', ['nom_cat_dep' => $nom_cat_dep]);
}

?>