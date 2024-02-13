import {postTo} from "../generalized/post-gen.js";
import {getWithParameters} from "../generalized/get-gen.js";
import {listerParcelles} from "./parcelle-admin-list.js";

const form = document.getElementById("parcelle-form");
const listContainer = document.getElementById("list-container");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-parcelle/update-parcelle.php",form,true).then(
        responseData => {
            getWithParameters("back/backoffice/crud-parcelle/select-parcelle.php",true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    console.log(responseData)
                    listerParcelles(responseData);
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