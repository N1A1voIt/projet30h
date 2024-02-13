
<?php
include_once("../../connexion.php");

function getPoidsTotalParCueilleur($id_cueuilleur, $date) {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT COALESCE(SUM(poids), 0) AS poids_total FROM 30h_cueillette 
                          WHERE id_cueuilleur = :id_cueuilleur AND date = :date");
    $stmt->bindValue(":id_cueuilleur", $id_cueuilleur, PDO::PARAM_INT);
    $stmt->bindValue(":date", $date, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $poids_total = $result['poids_total'];

    $dbh = null;

    return $poids_total;
}

function getPoidsMontantProche() {
    $dbh = PDOConnect();

    $stmt = $dbh->prepare("SELECT poids, montant FROM 30h_montant_salaire
                          ORDER BY date_montant_salaire DESC
                          LIMIT 1");
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $poids = $result['poids'];
    $montant = $result['montant'];

    $dbh = null;

    return ['poids' => $poids, 'montant' => $montant];
}

function getTableauValeurs($id_cueuilleur, $date) {
    $dbh = PDOConnect();

    $poidsTotal = getPoidsTotalParCueilleur($id_cueuilleur, $date);
    $montantProche = getPoidsMontantProche();

    $stmt = $dbh->prepare("SELECT minimum, bonus, malus FROM 30h_salaire_cueilleur WHERE daty = :date");
    $stmt->bindValue(":date", $date, PDO::PARAM_STR);
    $stmt->execute();
    $salaireInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $valeurs = 0;

    if ($poidsTotal == $salaireInfo['minimum']) {
        $valeurs = ($poidsTotal * $montantProche['montant']) / $montantProche['poids'];
    } elseif ($poidsTotal > $salaireInfo['minimum']) {
        $valeurs = ($poidsTotal * $montantProche['montant']) / $montantProche['poids'];
        $valeurs2 = (($poidsTotal - $salaireInfo['minimum']) * $montantProche['montant']) / $montantProche['poids'] * $salaireInfo['bonus'];
        $valeurs += $valeurs2;
    } elseif ($poidsTotal < $salaireInfo['minimum']) {
        $valeurs = ($poidsTotal * $montantProche['montant']) / $montantProche['poids'];
        $valeurs2 = (($poidsTotal - $salaireInfo['minimum']) * $montantProche['montant']) / $montantProche['poids'] * $salaireInfo['malus'];
        $valeurs += $valeurs2;
    }

    $resultArray = array(
        'date' => $date,
        'id_cueuilleur' => $id_cueuilleur,
        'bonus' => $salaireInfo['bonus'],
        'malus' => $salaireInfo['malus'],
        'valeurs' => $valeurs
    );

    $dbh = null;

    return $resultArray;
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

?>