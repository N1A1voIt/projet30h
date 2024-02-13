
<?php
include_once("../../connexion.php");


function changeFormat($date){
    $newdate = date("Y/m/d", strtotime($date));
    $daty = str_replace('/','-', $newdate);
    return $daty;
}
function getPoidsTotalParCueilleur($id_cueuilleur, $date) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT COALESCE(SUM(poids), 0) AS poids_total FROM 30h_cueillette 
                          WHERE id_cueuilleur = :id_cueuilleur AND date = :date");
    $stmt->bindValue(":id_cueuilleur", $id_cueuilleur, PDO::PARAM_INT);
    $stmt->bindValue(":date", changeFormat($date), PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $poids_total = $result['poids_total'];

    $dbh = null;

    return $poids_total;
}

function getPoidsMontantProche() {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT poid, montant FROM 30h_montant_salaire
                          ORDER BY date_montant DESC
                          LIMIT 1");
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $poids = $result['poid'];
    $montant = $result['montant'];

    $dbh = null;

    return ['poids' => $poids, 'montant' => $montant];
}

function getTableauValeurs($id_cueuilleur, $date) {
    $dbh = PDOConnect();

    $poidsTotal = getPoidsTotalParCueilleur($id_cueuilleur, $date);
    $montantProche = getPoidsMontantProche();

    $stmt = $dbh->prepare("SELECT minimum, bonus, mallus FROM 30h_salaire_cueilleur WHERE daty = :date");
    $stmt->bindValue(":date", changeFormat($date), PDO::PARAM_STR);
    $stmt->execute();
    $salaireInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultArray = null;
    if ($salaireInfo === false){

    }
    else{
        if ($poidsTotal == $salaireInfo['minimum']) {
            $valeurs = ($poidsTotal * $montantProche['montant']) / $montantProche['poids'];
        } elseif ($poidsTotal > $salaireInfo['minimum']) {
            $valeurs = ($poidsTotal * $montantProche['montant']) / $montantProche['poids'];
            $valeurs2 = (($poidsTotal - $salaireInfo['minimum']) * $montantProche['montant']) / $montantProche['poids'] * $salaireInfo['bonus'];
            $valeurs += $valeurs2;
        } elseif ($poidsTotal < $salaireInfo['minimum']) {
            $valeurs = ($poidsTotal * $montantProche['montant']) / $montantProche['poids'];
            $valeurs2 = (($poidsTotal - $salaireInfo['minimum']) * $montantProche['montant']) / $montantProche['poids'] * $salaireInfo['mallus'];
            $valeurs += $valeurs2;
        }
        $resultArray = array(
            'date' => $date,
            'id_cueuilleur' => $id_cueuilleur,
            'poids' =>  $montantProche['poids'],
            'bonus' => $salaireInfo['bonus'],
            'mallus' => $salaireInfo['mallus'],
            'valeurs' => $valeurs
        );
    }



    $dbh = null;

    return $resultArray;
}
function getTableauValeursEntreDeuxDates($id_cueuilleur, $dateDebut, $dateFin) {
    $sommeValeurs = 0;
    $sommePoids = 0;

    $currentDate = $dateDebut;
    $newdate = date("Y/m/d", strtotime($currentDate));
    $currentDate = str_replace('/','-', $newdate);
    $currentDate = getTomorrow($currentDate);

    $endDate = $dateFin;
    $newdate = date("Y/m/d", strtotime($endDate));
    $endDate = str_replace('/','-', $newdate);
    $endDate = getTomorrow($endDate);

    while ($currentDate <= $endDate) {
        $tableauValeurs = getTableauValeurs($id_cueuilleur, $currentDate);
        $sommeValeurs += $tableauValeurs['valeurs'];
        $sommePoids += $tableauValeurs['poids'];
        print ("Is working:".$currentDate);
    }
    $tableauValeurs = getTableauValeurs($id_cueuilleur, $currentDate);
    $resultArray = array(
        'date' => $tableauValeurs['date'],
        'id_cueuilleur' => $id_cueuilleur,
        'poids' => $sommePoids,
        'bonus' => $tableauValeurs['bonus'],
        'mallus' => $tableauValeurs['mallus'],
        'valeurs' => $sommeValeurs
    );
    return $resultArray;
}





function getTomorrow($date){
    $dateObj = new DateTime(($date));
    $dateObj->modify('+1 day');
    return $dateObj->format('Y-m-d');
}

function getTableauValeursPourTousCueilleurs($date) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT DISTINCT id_cueuilleur FROM 30h_cueillette");
    $stmt->execute();
    $idCueilleurs = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $tableauxValeursPourTousCueilleurs = array();

    foreach ($idCueilleurs as $id_cueuilleur) {
        $tableauValeurs = getTableauValeurs($id_cueuilleur, $date);
        $tableauxValeursPourTousCueilleurs[] = $tableauValeurs;
    }

    $dbh = null;

    return $tableauxValeursPourTousCueilleurs;
}

function getTableauValeursPourTousCueilleursEntre2Dates($dateDebut, $dateFin) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT DISTINCT id_cueuilleur FROM 30h_cueillette");
    $stmt->execute();
    $idCueilleurs = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $tableauxValeursPourTousCueilleurs = array();

    foreach ($idCueilleurs as $id_cueuilleur) {
        $tableauValeurs = getTableauValeursEntreDeuxDates($id_cueuilleur, $dateDebut, $dateFin);
        $tableauxValeursPourTousCueilleurs[] = $tableauValeurs;
    }

    $dbh = null;

    return $tableauxValeursPourTousCueilleurs;
}


?>