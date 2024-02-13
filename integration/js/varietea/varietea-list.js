import {getWithParameters} from "../generalized/get-gen.js";
import {postTo, postToFormDataVersion} from "../generalized/post-gen.js";

const listContainer = document.getElementById("list-container");
const form = document.getElementById("variety-form");

const varietyName = document.getElementById("variety-name");
const occupation = document.getElementById("occupation");
const rendement_ft = document.getElementById("rendement_ft");
const price = document.getElementById("price");


var linkToDelete = "back/delete-the.php";
var listParcelle = "back/select-the.php";


var linkToVariteaById= "back/"

getWithParameters(listParcelle,true).then(
    responseData => {
        listContainer.innerHTML = "";
        listeVarietea(responseData);
    }
).catch(
    error => {
        console.log(error)
    }
)

export function listeVarietea(responseData1) {
    var tab = listContainer;
    var responseData = responseData1;

    for (let i = 0; i < responseData.length; i++) {
        var row = document.createElement("tr");
        var colThe = document.createElement("td");
        console.log(responseData[i]['id_the']);
        colThe.innerHTML = responseData[i].nom_the;
        row.appendChild(colThe);
        var colOccupation= document.createElement("td");
        console.log(responseData[i].occupation);
        colOccupation.innerHTML = responseData[i].occupation;
        row.appendChild(colOccupation);
        var colRendement= document.createElement("td");
        console.log(responseData[i].rendement);
        colRendement.innerHTML = responseData[i].rendement;
        row.appendChild(colRendement);
        var colPrice= document.createElement("td");
        colPrice.innerHTML = responseData[i].price;
        row.appendChild(colPrice);
        var del_update = createEditDeleteButtons(responseData[i].id_the);

        var td = document.createElement("td");
        td.appendChild(del_update);
        row.appendChild(td);
        tab.appendChild(row);
    }
    return tab;
}

/*function createEditDeleteButtons(id) {
    return `<div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <p class="dropdown-item" onclick='deleteRow(${id})'>
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </p>
                    <p class="dropdown-item" onclick='deleteRow(${id})'>
                        <i class="bx bx-trash me-1"></i> Delete
                    </p>
                </div>
            </div>`;
}*/
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
    deleteButton.innerHTML = "<i class=\"bx bx-trash-alt me-1\"></i> Delete";
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
    form.append("id_the",id);
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
    input.name = "id_the";
    var formulaire = new FormData();
    formulaire.append("id_the",id);
    postToFormDataVersion("back/get-varietea-by-id.php",formulaire,true).then(
        responseData => {
            varietyName.value = responseData[0]['nom_the'];
            occupation.value = responseData[0]['occupation'];
            rendement_ft.value = responseData[0]['rendement'];
            price.value = responseData[0]['price'];
        }
    ).catch(

    )
    form.appendChild(input);
}
