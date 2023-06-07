import { checklogin_iframe } from "../../js/auth-check.js";
import {ComponentStore,baseurl} from "../../js/store.js";
import {ajaxRequest} from "../../js/ajax.js";


window.onload = (event) => {
    const iframeReady = new CustomEvent('iframeready');
    console.count("iframe ready");
    window.parent.document.dispatchEvent(iframeReady);
  };

console.count("home");

if(checklogin_iframe()){
    ajaxRequest('GET', baseurl+'content/album/random', (response) => {
      console.log(response);
        if (!response){
          console.log("error : (!response) random");
          //ComponentStore.displayAlbumHome('#discover',response)
        }else{
          ComponentStore.displayAlbumHome('#discover',response)
        };
    },'numbers=8'); 

 
}