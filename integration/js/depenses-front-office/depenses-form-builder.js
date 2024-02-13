import {getWithParameters} from "../generalized/get-gen.js";

const category_selector = document.getElementById("category");
getWithParameters("category-getter.php",true).then(
    responseData => {
        for (let i = 0; i < responseData.length; i++) {
            var opt = document.createElement("option");
            opt.value = responseData[i]['id_categ'];
            opt.text = responseData[i]['nom_categ'];
            category_selector.appendChild(opt);
        }
    }
).catch(
    error => {
        console.log(error);
    }
)