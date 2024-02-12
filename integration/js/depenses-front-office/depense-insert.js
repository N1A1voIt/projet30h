import {postTo} from "../generalized/postGen.js";

const form = document.getElementById("depense-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-depense/update-depense.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})