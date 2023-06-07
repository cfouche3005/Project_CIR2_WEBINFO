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
        ComponentStore.cleanPlaylistPage('#playlistcover','#playlistname','#playlistcreator','#playlistcreadate','#playlistmodifdate','#tracklist');
        ajaxRequest('GET', baseurl+'content/playlist', (response) => {
          console.log("response album page");
          console.log(response);
          console.log(response.playlist)
          console.log(response.musics)
          ComponentStore.displayplaylistPage('#playlistcover','#playlistname','#playlistcreator','#playlistcreadate','#playlistmodifdate','#tracklist',response,'#playlistplay','#playlistdel');
        },'id_playlist='+data);
      }
    },{once : true});
}