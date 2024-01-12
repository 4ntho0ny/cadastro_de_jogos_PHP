<?php
require_once './../modelo/funcoesJogo.php';

if (isset($_POST)) {

    session_start();

    if (isset($_POST['nomeJogo'], $_POST['valor'], $_POST['categoria']) && isset($_SESSION)) {
        // Colocando os POSTs em variáveis
        $nomeJogo = $_POST['nomeJogo'];
        $valor = $_POST['valor'];
        $categoria = $_POST['categoria'];

        // Se o nome ou a categoria estiver vazio(a), é retornado um aviso
        if ($nomeJogo == '' || $categoria == '') {
            header("Location: ./../layout/cadastrarJogo.php?msgErro=Os campos \"nome\" e \"categoria\" não podem ser vazios");
        }
        // Se o cadastro funcionar, é retornado uma mensagem de sucesso
        else if (cadastrarJogo($nomeJogo, $valor, $categoria)) {
            header("Location: ./../layout/colecaoJogos.php?msg=Jogo cadastrado com sucesso");
        }
        // Se o cadastro funcionar, é retornado uma mensagem de erro
        else {
            header("Location: ./../layout/cadastrarJogo.php?msgErro=Erro ao cadastrar");
        }
    }

    if (isset($_POST['novoNomeJogo'], $_POST['novoValor'], $_POST['novaCategoria']) && isset($_SESSION)) {
        // Colocando os POSTs em variáveis
        $id = $_POST['idJogo'];
        $nomeJogo = $_POST['novoNomeJogo'];
        $valor = $_POST['novoValor'];
        $categoria = $_POST['novaCategoria'];

        // Se o nome ou a categoria estiver vazio(a), é retornado um aviso
        if ($nomeJogo == '' || $categoria == '') {
            header("Location: ./../layout/alterarJogo.php?msgErro=Os campos \"nome\" e \"categoria\" não podem ser vazios&idEditar=$id");
        }
        // Se a alteracão funcionar, é retornado uma mensagem de sucesso
        else if (alterarJogo($id, $nomeJogo, $valor, $categoria)) {
            header("Location: ./../layout/colecaoJogos.php?msg=Jogo alterado com sucesso");
        }
        // Se o cadastro funcionar, é retornado uma mensagem de erro
        else {
            header("Location: ./../layout/alterarJogo.php?msgErro=Erro ao alterado");
        }
    }

}

if (isset($_GET)) {

    if (isset($_GET['idExcluir']) && isset($_SESSION)) {

        $jogoExcluido = apagarJogo($_GET['idExcluir']);

        if ($jogoExcluido) {
            header("Location: ./../layout/colecaoJogos.php?msg=Jogo excluido");
        } else {
            header("Location: ./../layout/colecaoJogos.php?msgErro=Jogo não excluido");
        }
    }

}
?>