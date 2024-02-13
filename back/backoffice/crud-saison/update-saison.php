<?php
include("../../function.php");

for ($i=0; $i < 13; $i++) { 
    $updated_valide = false; 
    updateRecord('30h_saison', ['valide' => $updated_valide], 'id_saison = :id_saison', ['id_saison' => $i]);
}

if(isset($_POST['months'])){
    $list = $_POST['months'];
    for ($i=0; $i < count($list); $i++) { 
        $id_saison_to_update = $list[$i];
        $updated_valide = true;
        
        updateRecord('30h_saison', ['valide' => $updated_valide], 'id_saison = :id_saison', ['id_saison' => $id_saison_to_update]);
    }
}

?>