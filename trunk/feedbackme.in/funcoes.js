/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/*INICIO funcoes de verificacao do cadastro */
function verificarCadastro(){
    var nome = document.getElementById("nome");
    var email = document.getElementById("email");
    var confEmail = document.getElementById("confEmail");
    var senha = document.getElementById("senha");
    var confSenha = document.getElementById("confSenha");

    alert(nome.value);
    alert(email.value);
    alert(confEmail.value);
    alert(senha.value);
    if(nome.value == ""){
        alert("Informe o nome");
        return false;
    }

    if(email.value == ""){
        alert("Informe o email");
        return false;
    }
    
    if(email.value != confEmail.value){
        alert("email e confirmacao diferentes!");
        return false;
    }

    if(!verificarEmail(email.value)){
        alert("Email invalido");
        return false;
    }

    if(senha.value == ""){
        alert("Informe uma senha");
        return false;
    }

    if(senha.value.toString().length < 6){
        alert("Senha deve ter pelo menos 6 digitos");
        return false;
    }

    if(senha.value != confSenha.value){
        alert("Senha e confirmacao diferentes");
        return false;
    }

   
    return true;
}

function verificarEmail(email){
    var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check=/@[\w\-]+\./;
    var checkend=/\.[a-zA-Z]{2,3}$/;
    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||
        (email.search(checkend) == -1)){
        return false;
    }
    return true;
}

/* FIM funcoes de verificacao do cadastro */

/* INICIO funcoes de verificacao de login */

function verificarLogin(){
    var email = document.getElementById("email");
    var senha = document.getElementById("senha");
    
    alert(email.value);
    if(email.value == ""){
        alert("Informe o email");
        return false;
    }

    if(senha.value == ""){
        alert("Informe uma senha");
        return false;
    }

    return true;

}

/* FIM funcoes de verificacao de login */

/* INICIO funcoes form */

function limpar(id){
    var campo = document.getElementById(id);
    campo.value = "";
}

/* FIM funcoes form */


/* INICIO funcoes cadastro de projeto */

function verificarCadastroProjeto(){
    var nome = document.getElementById("nome");

     if(nome.value == ""){
        alert("Informe o nome");
        return false;
    }

    return true;

}

/*FIM funcoes cadastro de projeto */

/*Login index*/

function mostrarLogin(){
       document.getElementById("login").style.display = 'block';
    
}

function esconderLogin(){
    document.getElementById("login").style.display = 'none';
}

/* funcoes ao entrar no site */

function iniciar(){
    esconderLogin();
}