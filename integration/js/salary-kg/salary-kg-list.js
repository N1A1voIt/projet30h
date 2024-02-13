import {getWithParameters} from "../generalized/get-gen.js";
import {postToFormDataVersion} from "../generalized/post-gen.js";

const listContainer = document.getElementById("list-container");
const form = document.getElementById("salary-depense-form");

var linkToDelete = "back/backoffice/crud-montant-depense/delete-montant-depense.php";
var listDepenses = "back/backoffice/crud-montant-depense/select-montant-depense.php";

getWithParameters(listDepenses,true).then(
    responseData => {
        listContainer.innerHTML = "";
        console.log(responseData)
        listerDepenses(responseData);
    }
).catch(
    error => {
        console.log(error)
    }
)
export function listerDepenses(responseData) {
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
        var del_update = createEditDeleteButtons(responseData[i]['id_montant_salaire']);

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
    form.append("id_montant_salaire",id);
    postToFormDataVersion(linkToDelete,form,true).then(
        responseData => {
            console.log("deleted");
            listContainer.innerHTML = "";
            getWithParameters(listParcelle,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    listeVarietea(responseData);
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
    var input = document.createElement("input");
    input.type = "hidden";
    input.value = id;
    input.name = "id_montant_salaire";
    form.appendChild(input);
}
