import {postTo} from "../generalized/post-gen.js";
import {getWithParameters} from "../generalized/get-gen.js";
import {listeVarietea} from "./varietea-list.js";

var linkToDelete = "back/delete-the.php";
var listParcelle = "back/select-the.php";
const listContainer = document.getElementById("list-container");

const form = document.getElementById("variety-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/insert-the.php",form,true).then(
        responseData => {
            getWithParameters(listParcelle,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    listeVarietea(responseData);
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