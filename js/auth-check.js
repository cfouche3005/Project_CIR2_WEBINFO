import { userstore } from "./store.js";

function checklogin_iframe() {
    if (!userstore.isconnected) {
            console.log("Not logged in iframe");
            const eventNotLogged = new CustomEvent('notlogged');
            window.parent.document.dispatchEvent(eventNotLogged);
            return false;
    }
        
}

function checklogin_main() {
    if (!userstore.isconnected) {
        console.log("Not logged in main");
        const eventNotLogged = new CustomEvent('notlogged');
        $('#inner-content').contentDocument.dispatchEvent(eventNotLogged);
    }
}

function handleNotLogged() {
    console.log("Not logged");
    const loginModal = new bootstrap.Modal( document.getElementById("loginModal"), {});
    location.href = "#/error";
    loginModal.show();
}

export {handleNotLogged, checklogin_iframe, checklogin_main }