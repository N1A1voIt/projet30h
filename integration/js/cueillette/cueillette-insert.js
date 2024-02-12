import {postTo} from "../generalized/postGen.js";

const form = document.getElementById("cueillette-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-cueillette/update-cueuillette.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})