import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("search-bar");
const listContainer = document.getElementById("list-container");
form.addEventListener("submit",(event) => {
    event.preventDefault();
    postTo("back/frontoffice/traitement-salaire-cueilleur/salaire-cueilleur-treatment.php",form,true).then(
        responseData => {
            displayTab(responseData)
        }
    ).catch(
        error => {
            console.log(error);
        }
    )
})
function displayTab(responseData) {
    listContainer.innerHTML = "";
    var tab = listContainer;
    for (let i = 0; i < responseData.length; i++) {
        var row = document.createElement("tr");
        for (const key in responseData[i]) {
            if (responseData[i].hasOwnProperty(key)) {
                var col = document.createElement("td");
                col.innerHTML = responseData[i][key];
                row.appendChild(col);
            }
        }
        tab.appendChild(row);
    }
    return tab;
}