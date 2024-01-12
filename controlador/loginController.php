<?php
require_once './../modelo/funcoesLogin.php';

if (!empty($_POST)) {

    $usuario = autenticarUsuario($_POST['email'], $_POST['senha']);

    if ($usuario != null) {

        session_start();

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        header("Location: ./../layout/colecaoJogos.php");
    } else {
        //Destruindo a sessão e encaminhando para a página de login
        header("Location: ./../layout/login.php?msg=Email ou senha incorretos");
    }

} else {
    /*Encaminha para a página de login com uma mensagem caso alguém 
    tente acessar diretamente este arquivo pela URL*/
    header("Location: ./../layout/login.php?msg=Você não tem permicão para acessar esta página");
}
?>