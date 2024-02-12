<?php
include("function.php");

if(isset($_POST['id_montant_salaire'])){
$id_montant_salaire_to_update = $_POST['id_montant_salaire'];
$updated_poid = $_POST['updated_poid'];
$updated_montant = $_POST['updated_montant'];
$updated_date = $_POST['updated_date'];

updateRecord('30h_montant_salaire', ['poid' => $updated_poid, 'montant' => $updated_montant, 'date' => $updated_date], 'id_montant_salaire = :id_montant_salaire', ['id_montant_salaire' => $id_montant_salaire_to_update]);
}
else{
    $id_montant_salaire_to_update = $_POST['id_montant_salaire'];
    $updated_poid = $_POST['updated_poid'];
    $updated_montant = $_POST['updated_montant'];
    $updated_date = $_POST['updated_date'];
    
    updateRecord('30h_montant_salaire', ['poid' => $updated_poid, 'montant' => $updated_montant, 'date' => $updated_date], 'id_montant_salaire = :id_montant_salaire', ['id_montant_salaire' => $id_montant_salaire_to_update]);
    }
?>