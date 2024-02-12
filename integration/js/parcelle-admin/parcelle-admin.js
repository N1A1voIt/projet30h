import {postTo} from "../generalized/postGen";

const form = document.getElementById("parcelle-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("pathToInsertParcelle.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})