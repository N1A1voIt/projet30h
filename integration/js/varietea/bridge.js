import {postTo} from "../generalized/postGen.js";

const form = document.getElementById("variety-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("pathToInsertVarietea.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})