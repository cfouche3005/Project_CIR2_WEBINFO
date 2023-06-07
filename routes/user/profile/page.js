import { checklogin_iframe } from "../../../js/auth-check.js";
import { UserStore,baseurl } from "../../../js/store.js";
import {ajaxRequest} from "../../../js/ajax.js";

let loginstatus = checklogin_iframe();


window.onload = (event) => {
    const iframeReady = new CustomEvent('iframeready');
    window.parent.document.dispatchEvent(iframeReady);
  };

if(loginstatus){
    console.log(UserStore.userdata);
    $('#nom').val(UserStore.userdata.nom_user);
    $('#prenom').val(UserStore.userdata.prenom_user);
    $('#mail').val(UserStore.userdata.mail_user);
    $('#date').val(UserStore.userdata.date_naissance);

    let samepass = false;

    $("#pass-verif").on('input',(e)=>{
        if ($("#password").val() != $("#pass-verif").val()){
            $("#error").text("Les mots de passe ne correspondent pas");
            samepass = false;
        }else{
            $("#error").text("");
            samepass = true;
        }
    });

    $('#info_modif').click((e)=>{

        if($('#password').val() != '' && samepass){

            e.preventDefault();
            const data = 'mp=true&id_user='+UserStore.userdata.id_user+'&lastname='+$('#nom').val()+'&surname='+$('#prenom').val()+'&birthdate='+$('#date').val()+'&mail='+$('#mail').val()+'&password='+$('#password').val()+'&pseudo='+$('#pseudo').val();
            ajaxRequest('PUT', baseurl+'user/profile', (response) => {
                if (!response){
                    console.log("error : (!response) mptrue");
                }else{
                    if(UserStore.SetUserData(response)){
                        $('#nom').val(UserStore.userdata.nom_user);
                        $('#prenom').val(UserStore.userdata.prenom_user);
                        $('#mail').val(UserStore.userdata.mail_user);
                        $('#date').val(UserStore.userdata.date_naissance);
                        console.log(UserStore.userdata)
                    }else{
                        console.log("error : Userstore mptrue");
                    }
                }
            }, data);

        }else{
            e.preventDefault();
            const data = 'mp=false&id_user='+UserStore.userdata.id_user+'&lastname='+$('#nom').val()+'&surname='+$('#prenom').val()+'&birthdate='+$('#date').val()+'&mail='+$('#mail').val()+'&pseudo='+UserStore.userdata.pseudo_user; 
            ajaxRequest('PUT', baseurl+'user/profile', (response) => {
                if (!response){
                    console.log("error : (!response) mpfalse");
                }else{
                    if(UserStore.SetUserData(response)){
                        $('#nom').val(UserStore.userdata.nom_user);
                        $('#prenom').val(UserStore.userdata.prenom_user);
                        $('#mail').val(UserStore.userdata.mail_user);
                        $('#date').val(UserStore.userdata.date_naissance);
                        console.log(UserStore.userdata)
                    }else{
                        console.log("error : Userstore mpfalse");
                    }
                }
            }, data);
        };

    });

    $('#logout').click((e)=>{
        window.sessionStorage.clear();
        const pagechange = new CustomEvent('pagechange', {detail: {href: '#/auth/login'}});
        window.parent.document.dispatchEvent(pagechange);
    });

}