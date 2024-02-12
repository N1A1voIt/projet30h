import {postTo} from "../generalized/postGen.js";

const form = document.getElementById("search-bar");

const reste = document.getElementById("reste");
const cueilli = document.getElementById("cueilli");

const coutRevient = document.getElementById("coutRevient");
form.addEventListener("submit",(event) => {
    event.preventDefault();
    postTo("back/frontoffice/every-result.php",form,true).then(
        responseData => {
            reste.innerHTML = responseData.poids_restant;
            cueilli.innerHTML = responseData.poids_cueilli;
            coutRevient.innerHTML = responseData.ca;
        }
    ).catch(
        error => {
            console.log(error);
        }
    )
})
