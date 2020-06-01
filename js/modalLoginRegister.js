$(document).ready(function(){
    //focus no campo email quando abrir a janela
    $('#modalLogin').on('shown.bs.modal', function () {
        $('#loginemail').focus();
    })
    //por defeito é escondido o form para registar
    $("#registerform").hide();
    
    //ao clicar para no link para logar, e escondido o formulario de registo e é mostrado o formulario login
    $("#loginuser").click(function () {
        $("#registerform").hide(800);
        $("#loginform").show(800, function () {
            $("#loginemail").focus();
        });
    });

    //ao clicar para no link para logar, e escondido o formulario de login e é mostrado o formulario registo
    $("#criaruser").click(function () {
        $("#loginform").hide(800);
        $("#registerform").show(800, function () {
            $("#registeruser").focus();
        });
    });

    
});