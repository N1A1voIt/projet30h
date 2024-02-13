<?php
require_once ("../function.php");
require_once ("../connexion.php");
function changeFormat($date){
    $newdate = date("Y/m/d", strtotime($date));
    $daty = str_replace('/','-', $newdate);
    return $daty;
}
function getPoidsCueillette($id_parcelle, $date_debut, $date_fin) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT COALESCE(SUM(poids), 0) AS poids_total FROM 30h_cueillette WHERE id_parcelle = :id_parcelle AND date BETWEEN :date_debut AND :date_fin");
    $stmt->bindValue(":id_parcelle", $id_parcelle, PDO::PARAM_INT);
    $stmt->bindValue(":date_debut", changeFormat($date_debut), PDO::PARAM_STR);
    $stmt->bindValue(":date_fin", changeFormat($date_fin), PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $poids_total = $result['poids_total'];

    $dbh = null;
    return $poids_total;
}

function calculerRendement($id_parcelle) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT 30h_the.rendement AS rendement_the, 30h_parcelle.surface AS surface_parcelle FROM 30h_the
                          JOIN 30h_parcelle ON 30h_the.id_the = 30h_parcelle.id_the
                          WHERE 30h_parcelle.id_parcelle = :id_parcelle");
    $stmt->bindValue(":id_parcelle", $id_parcelle, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $rendement_the = $result['rendement_the'];
    $surface_parcelle = $result['surface_parcelle'];

    $rendement_calculé = $rendement_the * $surface_parcelle;

    $dbh = null;

    return $rendement_calculé;
}

function calculerDepenseTotaleEntreDates($date_debut, $date_fin) {
    $dbh = PDOConnect();

    // Sélectionnez la somme des montants de dépenses entre les dates spécifiées
    $stmt = $dbh->prepare("SELECT COALESCE(SUM(montant), 0) AS depense_totale FROM 30h_depense WHERE date BETWEEN :date_debut AND :date_fin");
    $stmt->bindValue(":date_debut", changeFormat($date_debut), PDO::PARAM_STR);
    $stmt->bindValue(":date_fin", changeFormat($date_fin), PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $depense_totale = $result['depense_totale'];

    $dbh = null;

    return $depense_totale;
}

function getRestePoids($id_parcelle, $date_debut, $date_fin) {
    return calculerRendement($id_parcelle) - getPoidsCueillette($id_parcelle, $date_debut, $date_fin);
}

function getRestePoidsTotal($date_debut, $date_fin) {
    $cuilletteRecords = readRecords("30h_parcelle");
    $poidsTotalToutesParcelles = 0;

    foreach ($cuilletteRecords as $record) {
        $poidsTotalToutesParcelles += getRestePoids($record['id_parcelle'], $date_debut, $date_fin);
    }
    return $poidsTotalToutesParcelles;
}


function getPoidsCueilletteTotal( $date_debut, $date_fin) {
    $cuilletteRecords = readRecords("30h_cueillette");
    $poidsTotalToutesParcelles = 0;

    foreach ($cuilletteRecords as $record) {
        $poidsTotalToutesParcelles += getPoidsCueillette($record['id_parcelle'], $date_debut, $date_fin);
    }
    return $poidsTotalToutesParcelles;
}

function calculerRendementTotal() {
    $cuilletteRecords = readRecords("30h_cueillette");
    $poidsTotalToutesParcelles = 0;

    foreach ($cuilletteRecords as $record) {
        $poidsTotalToutesParcelles += calculerRendement($record['id_parcelle']);
    }
    return $poidsTotalToutesParcelles;
}

function getCoutRevientRendement($date_debut, $date_fin){
    if(calculerRendementTotal() == 0){
        return 0;
    }
    else return calculerDepenseTotaleEntreDates($date_debut, $date_fin) / calculerRendementTotal();
}

function getCoutRevientRecolte($date_debut, $date_fin){
    if(getPoidsCueilletteTotal($date_debut, $date_fin) == 0){
        return 0;
    }
    else return calculerDepenseTotaleEntreDates($date_debut, $date_fin) / getPoidsCueilletteTotal($date_debut,$date_fin);
}
?>