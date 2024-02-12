import {postTo} from "../generalized/postGen";

const form = document.getElementById("depenses-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("pathToInsertDepenses.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})