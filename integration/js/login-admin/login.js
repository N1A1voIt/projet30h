import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("form-login");
const errorr = document.getElementById("error");

form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("integration/php/login-admin/login.php",form,true).then(
        responseData => {
            if (responseData.retValue === 1){
                afficherErreur("")
            } else {
                window.location = "back_variete_the.html";
            }
        }
    ).catch(
        error => {
            alert("Oops il y a une erreure de traitement");
        }
    )
});
function afficherErreur(erreur) {
    var err = document.createElement("span");
    err.classList.add("error-block");
    err.innerHTML = "Courriel ou mot de passe incorrect";
    errorr.innerHTML = "";
    errorr.appendChild(err);
}