import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("search-bar");

const reste = document.getElementById("reste");
const cueilli = document.getElementById("cueilli");

const coutRevient = document.getElementById("coutRevient");
const benefices = document.getElementById("benefices");
const ventes = document.getElementById("ventes");
const depenses = document.getElementById("depenses");
form.addEventListener("submit",(event) => {
    event.preventDefault();
    postTo("back/frontoffice/every-result.php",form,true).then(
        responseData => {
            reste.innerHTML = responseData.poids_restant + " kg left";
            cueilli.innerHTML = responseData.poids_cueilli +" kg";
            coutRevient.innerHTML = responseData.ca+ "ar /kg";
            benefices.innerHTML = responseData.benefices+ "ar";
            ventes.innerHTML = responseData.ventes+ "ar";
            depenses.innerHTML = responseData.depenses+ "ar";
        }
    ).catch(
        error => {
            console.log(error);
        }
    )
})
