import { ajaxRequest } from "../../../js/ajax.js";
import { baseurl } from "../../../js/store.js";

let samepass = false;

$("#login").click((e)=>{
    const pagechange = new CustomEvent('pagechange', {detail: {href: '#/auth/login'}});
    window.parent.document.dispatchEvent(pagechange);
});

$("#pass-verif").on('input',(e)=>{
    if ($("#password").val() != $("#pass-verif").val()){
        $("#error").text("Les mots de passe ne correspondent pas");
        samepass = false;
    }else{
        $("#error").text("");
        samepass = true;
    }
});


$("#registerform").on('submit',(e)=>{
    e.preventDefault();
    if (samepass){
        const data = 'lastname='+$('#lastname').val()+'&surname='+$('#surname').val()+'&birthdate='+$('#date').val()+'&mail='+$('#mail').val()+'&password='+$('#password').val()+'&pseudo='+$('#pseudo').val();
        console.log(data);
        ajaxRequest('POST', baseurl+'auth/register',(result) => {
            console.log(result);
            if (!result){
                $('#toast').addClass("bg-danger");
                $('#toastmsd').text("Erreur d'inscription");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#liveToast'));
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#liveToast').removeClass("bg-danger");
                    $('#toastmsd').text("");
                },3000);
            }else{
                $('#toast').addClass("bg-success");
                $('#toastmsd').text("Inscription réussie");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#liveToast'));
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#liveToast').removeClass("bg-success");
                    $('#toastmsd').text("");
                    const pagechange = new CustomEvent('pagechange', {detail: {href: '#/auth/login'}});
                    window.parent.document.dispatchEvent(pagechange);
                },3000);
            }
        }, data);
    }
});
