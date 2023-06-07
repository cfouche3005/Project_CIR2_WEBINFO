import { checklogin_iframe } from "../../../../js/auth-check.js";
import { UserStore,baseurl,ComponentStore } from "../../../../js/store.js";
import {ajaxRequest} from "../../../../js/ajax.js";

if(checklogin_iframe()){
    ajaxRequest('GET', baseurl+'/user/albums', (response) => {
      console.log(response);
        if (!response){
          console.log("error : (!response) playlist");
          //ComponentStore.displayAlbumHome('#discover',response)
        }else{
          ComponentStore.displayAlbumLibrary('#albumlist',response)
        };
    },'id_user='+UserStore.userdata.id_user);

};