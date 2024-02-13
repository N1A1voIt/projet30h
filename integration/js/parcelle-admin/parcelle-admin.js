import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("parcelle-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-parcelle/update-parcelle.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})