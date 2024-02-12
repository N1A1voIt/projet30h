<?php
include("function.php");
if(isset($_POST['id_parcelle'])){
    $id_parcelle_to_update = $_POST['id_parcelle'];
    $updated_surface = $_POST['surface'];
    $updated_id_the = $_POST['id_the'];

    updateRecord('30h_parcelle', ['surface' => $updated_surface, 'id_the' => $updated_id_the], 'id_parcelle = :id_parcelle', ['id_parcelle' => $id_parcelle_to_update]);
}
else{    
    $surface = $_POST['surface'];
    $id_the = $_POST['id_the'];

    createRecord('30h_parcelle', ['surface' => $surface, 'id_the' => $id_the]);
}
?>