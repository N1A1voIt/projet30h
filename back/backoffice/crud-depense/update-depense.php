<?php
include("../../function.php");

if(isset($_POST['id_depense'])){
    $id_depense_to_update = $_POST['id_depense'];
    $updated_date = $_POST['updated_date'];
    $updated_id_cat = $_POST['updated_id_cat'];
    $updated_montant = $_POST['updated_montant'];
    
    updateRecord('30h_depense', ['date' => $updated_date, 'id_cat' => $updated_id_cat, 'montant' => $updated_montant], 'id_depense = :id_depense', ['id_depense' => $id_depense_to_update]);
}
else{
    $date = $_POST['date'];
    $id_cat = $_POST['id_cat'];
    $montant = $_POST['montant'];
    
    createRecord('30h_depense', ['date' => $date, 'id_cat' => $id_cat, 'montant' => $montant]);}
?>