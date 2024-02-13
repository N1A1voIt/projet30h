<?php
include("../../function.php");

if(isset($_POST['id_mois'])){
    $id_saison_to_update = $_POST['id_mois'];
    $updated_valide = $_POST['valide'];
    
    updateRecord('30h_saison', ['valide' => $updated_valide], 'id_saison = :id_saison', ['id_saison' => $id_saison_to_update]);
}

?>