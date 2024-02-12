import {postTo} from "../generalized/postGen.js";

const form = document.getElementById("form-login");
const body = document.getElementsByTagName("body")[0];

form.addEventListener("submit",function () {
    postTo("traitement.php",form,true).then(
        responseData => {
            if (responseData.retValue === 1){
                afficherErreur("")
            } else {
                window.location = "index.html"
            }
        }
    ).catch(
        error => {
            alert("Oops il y a une erreure de traitement");
        }
    )
})
function afficherErreur(erreur) {
    var err = document.createElement("span");
    err.classList.add("error-block");
    err.innerHTML = "Courriel ou mot de passe incorrect";
    body.appendChild(err);
}