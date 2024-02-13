import {postTo} from "../generalized/post-gen.js";
import {getWithParameters} from "../generalized/get-gen.js";
import {listerCategorieDepenses} from "./category-admin-list.js";

const form = document.getElementById("depenses-form");
const listContainer = document.getElementById("list-container");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-categorie-depense/update-cat-dep.php",form,true).then(
        responseData => {
            getWithParameters("back/backoffice/crud-categorie-depense/select-cat-dep.php",true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    console.log(responseData)
                    listerCategorieDepenses(responseData);
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