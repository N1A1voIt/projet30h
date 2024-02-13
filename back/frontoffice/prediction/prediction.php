<?php
include("../../function.php");
include("../../fonction-page-resultats.php");


function getMonthsBetweenDates($startDate, $endDate) {
    $startMonth = new DateTime($startDate);
    $endMonth = new DateTime($endDate);

    $months = array();

    while ($startMonth <= $endMonth) {
        $months[] = $startMonth->format('m');
        $startMonth->modify('+1 month');
    }
    return $months;
}

function debutDuMoisParMois($mois) {
    if ($mois < 1 || $mois > 12) {
        return "Mois invalide";
    }

    $dateDebut = date("Y-m-01", mktime(0, 0, 0, $mois, 1, date("Y")));

    return $dateDebut;
}
function contains($array, $j){
    for ($i=0; $i < count($array); $i++) { 
        if($array[$i] == $j){
            return true;
        }
    }
    return false;
}

function getTrue(){
    $result = array();
    $saison = readRecords('30h_saison');
    foreach($saison as $sea){
        if($sea['valide'] == true){
            $result[] = $sea['id_saison'];
        }
    }
    return $result;
}
function predictionRendement($id_parcelle, $endDate){
    $result = 0;
    $getTrue = getTrue();
    $startDate = date("Y/m/d");
    $array = getMonthsBetweenDates($startDate, $endDate);
    for ($i=0; $i < count($array) ; $i++) { 
        if(contains($getTrue, $array[$i])){
            $result = $result + calculerRendement($id_parcelle);
        }
    }
    return $result - getPoidsCueilletteTotal(debutDuMoisParMois($array[0]),$startDate);
}

function predictionRendementTotal( $date_fin) {
    $cuilletteRecords = readRecords("30h_cueillette");
    $poidsTotalToutesParcelles = 0;

    foreach ($cuilletteRecords as $record) {
        $poidsTotalToutesParcelles += predictionRendement($record['id_parcelle'], $date_fin);
    }
    return $poidsTotalToutesParcelles;
}

function getMontant($date_fin){
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT price FROM 30h_the
                          ORDER BY id_the DESC
                          LIMIT 1");
    $stmt->bindValue(":datyfin", $date_fin, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $valeurs =  predictionRendementTotal( $date_fin) * $result['price'];
    return $valeurs;
}

?>