import {getWithParameters} from "../generalized/get-gen.js";
import {postTo, postToFormDataVersion} from "../generalized/post-gen.js";

const listContainer = document.getElementById("list-container");
const form = document.getElementById("parcelle-form");

var linkToDelete = "back/backoffice/crud-parcelle/delete-parcelle.php";
var listParcelle = "back/backoffice/crud-parcelle/select-parcelle.php";

getWithParameters(listParcelle,true).then(
    responseData => {
        listContainer.innerHTML = "";
        displayVariety()
        listerParcelles(responseData);
    }
).catch(
    error => {
        console.log(error)
    }
)
export function listerParcelles(responseData) {
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
        var del_edit = createEditDeleteButtons(responseData[i]['id_parcelle']);
        var td = document.createElement("td");
        td.appendChild(del_edit);
        row.appendChild(td);
        tab.appendChild(row);
    }
    return tab;
}
function createButton(id){
    var btn = document.createElement("button");
    btn.addEventListener("click",()=>{
        deleteRow(id);
    });
    return btn;
}
function displayVariety() {
    const variety_field = document.getElementById("tea_variety");
    getWithParameters("back/select-the.php",true).then(
        responseData => {
            for (let i = 0; i < responseData.length; i++) {
                var opt = document.createElement("option");
                opt.value = responseData[i]['id_the'];
                opt.text = responseData[i]['nom_the'];
                variety_field.appendChild(opt);
            }
        }

    ).catch(
        error => {
            console.log(error)
        }
    )
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
    form.append("id_parcelle",id);
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
    if (document.getElementById("hidden-id") != null){
        document.getElementById("hidden-id").remove();
    }
    var input = document.createElement("input");
    input.type = "hidden";
    input.value = id;
    input.id = "hidden-id";
    input.name = "id_cueuilleur";
    form.appendChild(input);
}
