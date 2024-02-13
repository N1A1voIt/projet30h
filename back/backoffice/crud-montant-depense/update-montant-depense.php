<?php
include("../../function.php");

if(isset($_POST['id_montant_salaire'])){
$id_montant_salaire_to_update = $_POST['id_montant_salaire'];
$updated_poid = $_POST['poid'];
$updated_montant = $_POST['montant'];
$updated_date = $_POST['date'];
$newdate = date("Y/m/d", strtotime($updated_date));
$updated_date = str_replace('/','-', $newdate);

updateRecord('30h_montant_salaire', ['poid' => $updated_poid, 'montant' => $updated_montant, 'date' => $updated_date], 'id_montant_salaire = :id_montant_salaire', ['id_montant_salaire' => $id_montant_salaire_to_update]);
}
else{
    $updated_poid = $_POST['poid'];
    $updated_montant = $_POST['montant'];
    $updated_date = $_POST['date'];
    
    createRecord('30h_montant_salaire', ['poid' => $updated_poid, 'montant' => $updated_montant, 'date_montant' => $updated_date]);
}


?>