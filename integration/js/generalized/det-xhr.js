export function getXhr() {
    var xhr;
    try {
        return new ActiveXObject('Msxml2.XMLHTTP');
    } catch (e) {
        try {
            return new ActiveXObject('Microsoft.XMLHTTP');
        } catch (e2) {
            try {
                return new XMLHttpRequest();
            } catch (e3) {
                return false;
            }
        }
    }
}