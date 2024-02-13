<?php
require_once ('salaire-cueilleur.php');
$dateDebut = $_POST['date_debut'];
$dateFin = $_POST['date_fin'];
echo json_encode(getTableauValeursPourTousCueilleursEntre2Dates($dateDebut, $dateFin));
