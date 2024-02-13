import {postTo} from "../generalized/post-gen.js";

const form = document.getElementById("form-payment");
const listContainer = document.getElementById("list-container");
form.addEventListener("submit",()=>{
   postTo("back/frontoffice/payment-list.php",form,true).then(
       responseData => {
           listContainer.innerHTML = "";
           displaySalary(responseData)
       }
   ).catch(
       error => {

       }
   )
});
function displaySalary(responseData){
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