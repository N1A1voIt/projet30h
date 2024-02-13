import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("seasons-form");
form.addEventListener("submit",(event) => {
    event.preventDefault();
    postTo("back/backoffice/crud-saison/update-saison.php",form,true).then(
        responseData=>{
            console.log("success");
        }
    ).catch(
        error => {
            console.log(error);
        }
    )
});
