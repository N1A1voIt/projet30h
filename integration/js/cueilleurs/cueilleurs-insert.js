import {postTo} from "../generalized/postGen";

const form = document.getElementById("cueilleur-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("pathToInsertCueilleurs.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})