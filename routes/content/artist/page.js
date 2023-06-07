import { ComponentStore,baseurl } from "../../../js/store.js";
import { checklogin_iframe } from "../../../js/auth-check.js";
import {ajaxRequest} from "../../../js/ajax.js";

let loginstatus = checklogin_iframe();

window.onload = (event) => {
    const iframeReady = new CustomEvent('iframeready');
    window.parent.document.dispatchEvent(iframeReady);
};

if(loginstatus){
    window.document.addEventListener('pagewithdata', (e) => {
        if(e.detail.data){
            const data = window.parent.location.hash.split('$')[1];
            console.log(data)
            ComponentStore.cleanArtistPage('#artistcover','#artistname','#artisttype','#artistinfo','#albumlink','#tracklist');
            ajaxRequest('GET', baseurl+'content/artist', (response) => {
                console.log("response artist page");
                ComponentStore.displayAlbumPage('#artistcover','#artistname','#artisttype','#artistinfo','#albumlink','#tracklist',response);
            },'id_artist='+data);
        }
    },{once : true});
}