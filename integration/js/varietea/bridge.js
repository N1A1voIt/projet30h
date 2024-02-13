import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("variety-form");
form.addEventListener("submit",function (event) {
    event.preventDefault();
    postTo("back/insert-the.php",form,true).then(
        responseData => {
            console.log("success");
        }
    ).catch(
        error => {
            alert(error);
        }
    );
})