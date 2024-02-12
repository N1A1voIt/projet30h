import {getWithParameters} from "../generalized/getGen";

const cueilleurField = document.getElementById("cueilleur-field");
const parcelleField = document.getElementById("parcelle-field");

function fillCueilleur(responseData) {
    for (let i = 0; i < responseData.length; i++) {
        var idCueilleur = responseData[i]["idCueilleur"];
        var nomCueilleur = responseData[i]["nomCueilleur"];
        var option = document.createElement("option");
        option.value = idCueilleur;
        option.text = nomCueilleur;
        cueilleurField.appendChild(option);
    }
}
function fillParcelle(responseData) {
    for (let i = 0; i < responseData.length; i++) {
        var idParcelle = responseData[i]["idParcelle"];
        var option = document.createElement("option");
        option.value = idParcelle;
        option.text = idParcelle;
        cueilleurField.appendChild(option);
    }
}
function fillAll(responseData){
    getWithParameters("saisie-cueillete-form.php",true).then(
        responseData => {
            var cueilleur = responseData.cueilleur;
            var parcelle = responseData.parcelle;
            fillCueilleur(cueilleur);
            fillParcelle(parcelle);
        }
    ).catch(
        error => {
            alert(error)
        }
    )
}