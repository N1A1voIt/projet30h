import {getWithParameters} from "../generalized/get-gen.js";
import {postTo, postToFormDataVersion} from "../generalized/post-gen.js";

const cueilleurField = document.getElementById("cueilleur-field");
const parcelleField = document.getElementById("parcelle-field");
const ceuilletteDate = document.getElementById("date");
const montant = document.getElementById("montant");
const weight = document.getElementById("weight");
const form = document.getElementById("form-cueillette");

fillAll();

form.addEventListener("submit",(event) => {
    event.preventDefault();
    var idParcelle = parcelleField.value;
    getParcelleContent(parcelleField);
})
function getParcelleContent(parcelleField){
    var form2 = new FormData();
    form2.append("id_parcelle",parcelleField.value);
    form2.append("date_debut",ceuilletteDate.value);
    var lastDayOfCurrentMonth = new Date(ceuilletteDate.value.getFullYear, ceuilletteDate.value.getMonth +  1,  0);
    form2.append("date_fin",lastDayOfCurrentMonth.toString());
    console.log(form2);
    postToFormDataVersion("back/frontoffice/reste-poids.php",form2,false).then(
        response => {
            if (response.poids_reste < weight.value){
                alert("Le stock est manquant");
            } else {
                console.log(form);
                postTo("back/backoffice/crud-cueillette/update-cueuillette.php",form,true).then(
                    responseData => {
                        console.log("success");
                    }
                ).catch(
                    error =>{
                        console.log(error);
                    }
                )
            }
        }
    ).catch(
        error => {
            console.log(error);
        }
    )
}
function fillCueilleur(responseData) {
    for (let i = 0; i < responseData.length; i++) {
        var idCueilleur = responseData[i]["id_cueuilleur"];
        var nomCueilleur = responseData[i]["nom"];
        var option = document.createElement("option");
        option.value = idCueilleur;
        option.text = nomCueilleur;
        cueilleurField.appendChild(option);
    }
}
function fillParcelle(responseData) {
    for (let i = 0; i < responseData.length; i++) {
        var idParcelle = responseData[i]["id_parcelle"];
        var option = document.createElement("option");
        option.value = idParcelle;
        option.text = idParcelle;
        parcelleField.appendChild(option);
    }
}
function fillAll(){
    getWithParameters("back/tableaux.php",true).then(
        responseData => {
            var cueilleur = responseData.cueilleur;
            var parcelle = responseData.id_parcelle;
            fillCueilleur(cueilleur);
            fillParcelle(parcelle);
        }
    ).catch(
        error => {
            console.log(error)
        }
    )
}