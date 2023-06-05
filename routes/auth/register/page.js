import { ajaxRequest } from "../../../js/ajax.js";

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
        console.log('lastname='+$('#lastname').val()+'&surname='+$('#surname').val()+'&birthdate='+$('#date').val()+'&mail='+$('#mail').val()+'&password='+$('#password').val()-'&pseudo='+$('#pseudo').val());
        ajaxRequest('POST', '/php/request.php/auth/register',(result) => {
            if (!result){
                $('#toast').addClass("bg-danger");
                $('#toastmsd').text("Erreur d'inscription");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#toastliveToast'));
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#toast').removeClass("bg-danger");
                    $('#toastmsd').text("");
                },3000);
            }else{
                $('#toast').addClass("bg-success");
                $('#toastmsd').text("Inscription réussie");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance($('#toastliveToast'));
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                    $('#toast').removeClass("bg-success");
                    $('#toastmsd').text("");
                    const pagechange = new CustomEvent('pagechange', {detail: {href: '#/auth/login'}});
                    window.parent.document.dispatchEvent(pagechange);
                },3000);
            }
        }, 'lastname='+$('#lastname').val()+'&surname='+$('#surname').val()+'&date='+$('#date').val()+'&mail='+$('#mail').val()+'&password='+$('#password').val());
    }
});
