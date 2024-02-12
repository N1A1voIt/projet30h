import {getXhr} from "./detXhr.js";

function checkStatus(xhr, resolve, reject) {
    if (xhr.status === 200) {
        console.log(xhr.responseText);
        if (xhr.responseText !== "") {
            try {
                var responseData = JSON.parse(xhr.responseText);
                resolve(responseData);
            } catch (e) {
                reject(e);
            }
        } else {
            console.log("No return from the server but it may be what you truly want!");
            resolve(null);
        }
    } else {
        reject(new Error(xhr.statusText));
    }
}

export function postTo(path, form, async) {
    return new Promise((resolve, reject) => {
        var xhr = getXhr();
        xhr.onreadystatechange = function () {
            if (xhr.readyState ===  4) {
                console.log("readyState:"+4);
                checkStatus(xhr, resolve, reject);
            }
        };
        xhr.open("POST", path, async);
        xhr.send(new FormData(form));
    });
}



/*postTo('/api/endpoint', formElement, true)
    .then(responseData => {
        // Handle the response data
        console.log(responseData);
    })
    .catch(error => {
        // Handle errors
        console.error('Error:', error);
    });
*/