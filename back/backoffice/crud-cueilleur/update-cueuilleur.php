<?php
include("function.php");

if(isset($_POST['id_cueuilleur'])){
$id_cueuilleur_to_update = $_POST['id_cueuilleur'];
$updated_nom = $_POST['nom'];
$updated_genre = $_POST['genre'];
$updated_ddn = $_POST['ddn'];

updateRecord('30h_cueuilleur', ['nom' => $updated_nom, 'genre' => $updated_genre, 'ddn' => $updated_ddn], 'id_cueuilleur = :id_cueuilleur', ['id_cueuilleur' => $id_cueuilleur_to_update]);
}
else{
    $nom = $_POST['nom'];
    $genre = $_POST['genre'];
    $ddn = $_POST['ddn'];

    createRecord('30h_cueuilleur', ['nom' => $nom, 'genre' => $genre, 'ddn' => $ddn]);
}
?>