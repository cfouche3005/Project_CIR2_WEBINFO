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
        ComponentStore.cleanAlbumPage('#albumcover','#albumname','#albumartist','#albumdate','#albumtype','#tracklist');
        ajaxRequest('GET', baseurl+'content/album', (response) => {
          console.log("response album page");
          ComponentStore.displayAlbumPage('#albumcover','#albumname','#albumartist','#albumdate','#albumtype','#tracklist',response,'#albumplay','#albumadd');
        },'id_album='+data);
      }
    },{once : true});
}