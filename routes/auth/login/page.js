import { ajaxRequest } from "../../../js/ajax.js";
import { UserStore,baseurl } from "../../../js/store.js";


window.onload = (event) => {
    const iframeReady = new CustomEvent('iframeready');
    window.parent.document.dispatchEvent(iframeReady);
  };


$("#inscrire").click((e)=>{
    const pagechange = new CustomEvent('pagechange', {detail: {href: '#/auth/register'}});
    window.parent.document.dispatchEvent(pagechange);
});

$("#loginform").on('submit',(e)=>{
    e.preventDefault();
    console.log('mail='+$('#mail').val()+'&password='+$('#password').val())
    ajaxRequest('POST', baseurl+'auth/login',(result) => {
        console.log(result);
        if (!result){
            $('#toast').addClass("bg-danger");
            $('#toastmsd').text("Erreur de connexion");
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#liveToast'));
            toastBootstrap.show();
            setTimeout(() => {
                toastBootstrap.hide();
                $('#toast').removeClass("bg-danger");
                $('#toastmsd').text("");
            },3000);
        }else{
            
            if(UserStore.SetUserData(result)){
                $('#toast').addClass("bg-success");
                $('#toastmsd').text("Connexion réussie");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#liveToast'));
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#toast').removeClass("bg-success");
                    $('#toastmsd').text("");
                    window.parent.location.hash = '#/';
             },3000);
            }else{
                $('#toast').addClass("bg-danger");
                $('#toastmsd').text("Erreur de connexion");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#liveToast'));
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#toast').removeClass("bg-danger");
                    $('#toastmsd').text("");
                },3000);
            };
        }
    }, 'mail='+$('#mail').val()+'&password='+$('#password').val());
});

