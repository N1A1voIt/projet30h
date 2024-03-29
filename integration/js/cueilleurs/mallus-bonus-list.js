import {getWithParameters} from "../generalized/get-gen.js";
import {postTo, postToFormDataVersion} from "../generalized/post-gen.js";

const listContainer = document.getElementById("list-container-mallus-bonus");
const form = document.getElementById("mallus-form");

const min_weight = document.getElementById("min_weight");
const bonus = document.getElementById("bonus");
const mallus = document.getElementById("mallus");
const date = document.getElementById("date");


var linkToDelete = "back/backoffice/crud-salaire-cueilleur/delete-salaire-cueuilleur.php";
var listParcelle = "back/backoffice/crud-salaire-cueilleur/select-salaire-cueuilleur.php";

getWithParameters(listParcelle,true).then(
    responseData => {
        listContainer.innerHTML = "";
        console.log(responseData)
        listerMallusBonus(responseData);
    }
).catch(
    error => {
        console.log(error)
    }
)
export function listerMallusBonus(responseData) {
    var tab = listContainer
    for (let i = 0; i < responseData.length; i++) {
        var row = document.createElement("tr");
        for (const key in responseData[i]) {
            if (responseData[i].hasOwnProperty(key)) {
                var col = document.createElement("td");
                col.innerHTML = responseData[i][key];
                row.appendChild(col);
            }
        }
        var del_update = createEditDeleteButtons(responseData[i]['id_salaire_cueilleur'])
        var td = document.createElement("td");
        td.appendChild(del_update);
        row.appendChild(td);
        tab.appendChild(row);
    }
    return tab;
}

function createEditDeleteButtons(id) {
    var div = document.createElement("div");
    div.classList.add("dropdown");
    var button = document.createElement('button');

    // Set the attributes and classes
    button.setAttribute('type', 'button');
    button.classList.add('btn', 'p-0', 'dropdown-toggle', 'hide-arrow');
    button.setAttribute('data-bs-toggle', 'dropdown');
    var icon = document.createElement('i');
    icon.classList.add('bx', 'bx-dots-vertical-rounded');

    // Append the icon to the button
    button.appendChild(icon);
    div.appendChild(button);

    var divDrop = document.createElement("div");
    divDrop.classList.add("dropdown-menu");

    // Other setup code...
    var editButton = document.createElement("p");
    editButton.classList.add("dropdown-item");
    editButton.innerHTML = "<i class=\"bx bx-edit-alt me-1\"></i> Edit";
    editButton.addEventListener('click', function() {
        update(id);
    });
    divDrop.appendChild(editButton);
    var deleteButton = document.createElement("p");
    deleteButton.classList.add("dropdown-item");
    deleteButton.innerHTML = "<i class=\"bx bx-delete-alt me-1\"></i> Delete";
    deleteButton.addEventListener('click', function() {
        deleteRow(id);
    });
    divDrop.appendChild(deleteButton);
    div.appendChild(divDrop);
    // Repeat for delete button
    return div;
}


function deleteRow(id) {
    var form = new FormData();
    form.append("id_salaire_cueilleur",id);
    postToFormDataVersion(linkToDelete,form,true).then(
        responseData => {
            console.log("deleted");
            listContainer.innerHTML = "";
            getWithParameters(listParcelle,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    listerMallusBonus(responseData);
                }
            ).catch(
                error => {
                    alert(error)
                }
            )
        }
    ).catch(
        error => {
            alert(error);
        }
    )
}

function update(id) {
    if (document.getElementById("hidden-id") != null){
        document.getElementById("hidden-id").remove();
    }
    var input = document.createElement("input");
    input.type = "hidden";
    input.value = id;
    input.id = "hidden-id";
    input.name = "id_salaire_cueilleur";
    var formulaire = new FormData();
    formulaire.append("id_salaire_cueilleur",id);
    postToFormDataVersion("back/backoffice/crud-salaire-cueilleur/select-salaire-cueilleur-by-id.php",formulaire,true).then(
        responseData => {
            min_weight.value = responseData[0]['minimum'];
            mallus.value = responseData[0]['mallus'];
            bonus.value = responseData[0]['bonus'];
            date.value = responseData[0]['daty'];
        }
    ).catch(

    )
    form.appendChild(input);
}
