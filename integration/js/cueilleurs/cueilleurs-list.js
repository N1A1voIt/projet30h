import {getWithParameters} from "../generalized/getGen.js";
import {postTo} from "../generalized/postGen";

const listContainer = document.getElementById("list-container");

var linkToDelete = "cueilleurs-deleter.php";
var listParcelle = "list-cueilleurs.php";

getWithParameters(listParcelle,true).then(
    responseData => {
        listContainer.innerHTML = "";
        listContainer.appendChild(listerCueilleurs(responseData));
    }
).catch(
    error => {
        alert(error)
    }
)
function listerCueilleurs(responseData) {
    var tab = document.getElementById("")
    for (let i = 0; i < responseData.length; i++) {
        var row = document.createElement("tr");
        for (const key in responseData[i]) {
            if (responseData[i].hasOwnProperty(key)) {
                var col = document.createElement("td");
                col.innerHTML = responseData[i][key];
                row.appendChild(col);
            }
        }
        var del = document.createElement("td");
        del.appendChild(createButton(responseData[i].id));
        row.appendChild(del);
        var update = document.createElement("td");
        row.appendChild(update);
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
            getWithParameters(listParcelle,true).then(
                responseData => {
                    listContainer.innerHTML = "";
                    listContainer.appendChild(listerCueilleurs(responseData));
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