import {getWithParameters} from "../generalized/get-gen.js";

const category_selector = document.getElementById("category");
getWithParameters("back/backoffice/crud-categorie-depense/select-cat-dep.php",true).then(
    responseData => {
        console.log(responseData);
        for (let i = 0; i < responseData.length; i++) {
            var opt = document.createElement("option");
            opt.value = responseData[i]['id_cat_dep'];
            opt.text = responseData[i]['nom_cat_dep'];
            category_selector.appendChild(opt);
        }
    }
).catch(
    error => {
        console.log(error);
    }
)