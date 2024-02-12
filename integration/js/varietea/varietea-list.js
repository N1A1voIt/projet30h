import {getWithParameters} from "../generalized/getGen.js";
import {postTo} from "../generalized/postGen.js";

const listContainer = document.getElementById("list-container");

var linkToDelete = "parcelle-deleter.php";
var listParcelle = "back/select-the.php";

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

function listeVarietea(responseData1) {
    var tab = listContainer;
    var responseData = responseData1;

    for (let i = 0; i < responseData.length; i++) {
        var row = document.createElement("tr");
        var colThe = document.createElement("td");
        console.log(responseData[i]['id_the']);
        colThe.innerHTML = responseData[i].id_the;
        row.appendChild(colThe);
        var colOccupation= document.createElement("td");
        console.log(responseData[i].occupation);
        colOccupation.innerHTML = responseData[i].occupation;
        row.appendChild(colOccupation);
        var colRendement= document.createElement("td");
        console.log(responseData[i].rendement);
        colRendement.innerHTML = responseData[i].rendement;
        row.appendChild(colRendement);

        var del_update = "<div class=\"dropdown\">\n" +
            " <button type=\"button\" class=\"btn p-0 dropdown-toggle hide-arrow\" data-bs-toggle=\"dropdown\">\n" +
            " <i class=\"bx bx-dots-vertical-rounded\"></i>\n" +
            " </button>\n" +
            " <div class=\"dropdown-menu\">\n" +
            " <p class=\"dropdown-item\" onclick='deleteRow(responseData[i]['id_the'])' \n" +
            " ><i class=\"bx bx-edit-alt me-1\"></i> Edit</p\n" +
            " >\n" +
            " <p class=\"dropdown-item\" onclick='deleteRow(responseData[i].id_the)'\n" +
            " ><i class=\"bx bx-trash me-1\"></i> Delete</p\n" +
            " >\n" +
            " </div>\n" +
            " </div>"
        var td = document.createElement("td");
        td.innerHTML = del_update;
        row.appendChild(td);
        tab.appendChild(row);
    }
    return tab;
}

function createButton(id) {
    var btn = document.createElement("button");
    btn.addEventListener("click",()=>{
        deleteRow(id);
    });
    return btn;
}
function deleteRow(id) {
    var form = new FormData();
    form.append("idRow",id);
    postTo(linkToDelete,form,true).then(
        responseData => {
            console.log("deleted");
            listContainer.innerHTML = "";
            getWithParameters(listParcelle,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    listContainer.appendChild(listeVarietea(responseData));
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