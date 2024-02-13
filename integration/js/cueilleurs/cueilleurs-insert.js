import {postTo} from "../generalized/post-gen.js";
import {listerCueilleurs} from "./cueilleurs-list.js";
import {getWithParameters} from "../generalized/get-gen.js";


const form = document.getElementById("cueilleur-form");
const listContainer = document.getElementById("list-container");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-cueilleur/update-cueuilleur.php",form,true).then(
        responseData => {
            getWithParameters("back/backoffice/crud-cueilleur/select-cueuilleur.php",true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    console.log(responseData)
                    listerCueilleurs(responseData);
                }
            ).catch(
                error => {
                    console.log(error)
                }
            )
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})