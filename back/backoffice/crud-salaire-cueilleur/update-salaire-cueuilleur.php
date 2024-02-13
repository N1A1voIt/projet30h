<?php
include("../../function.php");

if(isset($_POST['id_salaire_cueilleur'])){
$id_cueuilleur_to_update = $_POST['id_salaire_cueilleur'];
$updated_minimum = $_POST['minimum'];
$updated_mallus = $_POST['mallus'];
$updated_bonus = $_POST['bonus'];
$updated_daty = $_POST['daty'];
$newdate = date("Y/m/d", strtotime($updated_daty));
$updated_daty = str_replace('/','-', $newdate);
updateRecord('30h_salaire_cueilleur', ['minimum' => $updated_minimum, 'mallus' => $updated_mallus,'bonus' => $updated_bonus, 'daty' => $updated_daty], 'id_salaire_cueilleur = :id_salaire_cueilleur', ['id_salaire_cueilleur' => $id_cueuilleur_to_update]);
}
else{
    $minimum = $_POST['minimum'];
    $mallus = $_POST['mallus'];
    $bonus = $_POST['bonus'];
    $daty = $_POST['daty'];
    $newdate = date("Y/m/d", strtotime($daty));
    $updated_daty = str_replace('/','-', $newdate);
    createRecord('30h_salaire_cueilleur',['minimum' => $minimum, 'mallus' => $mallus,'bonus' => $bonus, 'daty' => $daty]);
}
?>