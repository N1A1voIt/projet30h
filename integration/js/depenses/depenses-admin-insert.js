import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("depenses-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/backoffice/crud-category-depense/update-category-depense.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})