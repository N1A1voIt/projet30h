import {getWithParameters} from "../generalized/getGen.js";
import {postTo} from "../generalized/postGen.js";

const listContainer = document.getElementById("list-container");

var linkToDelete = "parcelle-deleter.php";
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
function listerParcelles(responseData) {
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
                    listContainer.appendChild(listerParcelles(responseData));
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