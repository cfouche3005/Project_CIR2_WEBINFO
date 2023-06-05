import { ajaxRequest } from "../../../js/ajax.js";
import { userstore } from "../../../js/store.js";

$("#inscrire").click((e)=>{
    const pagechange = new CustomEvent('pagechange', {detail: {href: '#/auth/register'}});
    window.parent.document.dispatchEvent(pagechange);
});

$("#loginform").on('submit',(e)=>{
    e.preventDefault();
    console.log('mail='+$('#mail').val()+'&password='+$('#password').val())
    ajaxRequest('POST', '/php/request.php/auth/login',(result) => {
        if (!result){
            $('#toast').addClass("bg-danger");
            $('#toastmsd').text("Erreur de connexion");
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#toastliveToast'));
            toastBootstrap.show();
            setTimeout(() => {
                toastBootstrap.hide();
                $('#toast').removeClass("bg-danger");
                $('#toastmsd').text("");
            },3000);
        }else{
            $('#toast').addClass("bg-success");
            $('#toastmsd').text("Connexion réussie");
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#toastliveToast'));
            toastBootstrap.show();
            if(userstore.SetUserData(result)){
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#toast').removeClass("bg-success");
                    $('#toastmsd').text("");
                    const pagechange = new CustomEvent('pagechange', {detail: {href: '#/'}});
                    window.parent.document.dispatchEvent(pagechange);
             },3000);
            }else{
                $('#toast').addClass("bg-danger");
                $('#toastmsd').text("Erreur de connexion");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#toastliveToast'));
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

