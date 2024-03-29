import {getWithParameters} from "../generalized/get-gen.js";
import {postTo} from "../generalized/post-gen.js";

const listContainer = document.getElementById("list-container");

var linkToDelete = "cueilleurs-deleter.php";
var listDepenses = "back/backoffice/crud-category-depense/select-category-depense.php";

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
function listerDepenses(responseData) {
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
        var del_update = "<div class=\"dropdown\">\n" +
            " <button type=\"button\" class=\"btn p-0 dropdown-toggle hide-arrow\" data-bs-toggle=\"dropdown\">\n" +
            " <i class=\"bx bx-dots-vertical-rounded\"></i>\n" +
            " </button>\n" +
            " <div class=\"dropdown-menu\">\n" +
            " <p class=\"dropdown-item\" \n" +
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
function createButton(id){
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
            getWithParameters(listDepenses,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    listContainer.appendChild(listerDepenses(responseData));
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