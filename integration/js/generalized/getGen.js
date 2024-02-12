import {getXhr} from "./detXhr.js";

function urlToKeyValueMapping(urlString){
    var url = new URL(urlString);
    var searchParams = url.searchParams;
    var params = {};
    for (let [key, value] of searchParams.entries()) {
        params[key] = value;
    }
    return params;
}
export function getWithParameters(url, async) {
    return new Promise((resolve, reject) => {
        var xhr = getXhr();
        xhr.open("GET",url, async);
        xhr.onload = function() {
            if (xhr.status ===  200) {
                resolve(JSON.parse(xhr.response));
            } else {
                reject(new Error(xhr.statusText));
            }
        };
        xhr.onerror = function() {
            reject(new Error("Network Error"));
        };
        xhr.send();
    });
}

/*
getWithParameters(url, params, true)
    .then(response => {
        console.log(response);
    })
    .catch(error => {
        console.error('Error:', error);
    });
*/

//url + '?' + new URLSearchParams(params).toString()