import {postTo} from "../generalized/post-gen.js";
import {getWithParameters} from "../generalized/get-gen.js";
import {listerMallusBonus} from "./mallus-bonus-list.js";


const listContainer = document.getElementById("list-container-mallus-bonus");
const form = document.getElementById("mallus-form");

form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-mallus-bonus/update-mallus-bonus.php",form,true).then(
        responseData => {
            getWithParameters("back/backoffice/crud-mallus-bonus/select-mallus-bonus.php",true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    console.log(responseData)
                    listerMallusBonus(responseData);
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