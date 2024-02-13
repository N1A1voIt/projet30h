import {postTo} from "../generalized/post-gen.js";
import {getWithParameters} from "../generalized/get-gen.js";
import {listerDepenses} from "./salary-kg-list.js";

const form = document.getElementById("salary-depense-form");
const listContainer = document.getElementById("list-container");

form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-montant-depense/update-montant-depense.php",form,true).then(
        responseData => {
            console.log("success");
            var listDepenses = "back/backoffice/crud-montant-depense/select-montant-depense.php";

            getWithParameters(listDepenses,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    console.log(responseData)
                    listerDepenses(responseData);
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