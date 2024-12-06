<?php
require_once './../modelo/funcoesJogo.php';
session_start();

if (empty($_SESSION)) {
    //Não possui nenhuma sessão definida, logo emcaminha para a página principal 
    header("Location: ./../layout/login.php?msg=Usuário não logado");
    die();
}

$dadosJogo = listarJogoId($_GET['idEditar']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Alteracão dos dados do Jogo</title>
</head>
<style>
    .cadastro {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .titulo {
        text-align: center;
        margin: 5px;
    }

    #mensagem {
        color: red;
    }
</style>

<body>
    <h1 class="titulo">Alteracão dos dados do Jogo</h1>
    <form action="./../controlador/jogoController.php" class="cadastro" method="post">
        <label for="">Id</label>
        <input type="number" name="idJogo" value="<?php echo $dadosJogo->id; ?>" readonly>
        <label for="">Nome do Jogo</label>
        <input type="text" name="novoNomeJogo" value="<?php echo $dadosJogo->nomeJogo; ?>">
        <label for="">Valor</label>
        <input type="number" name="novoValor" value="<?php echo $dadosJogo->valor; ?>">
        <label for="">Categoria</label>
        <input type="text" name="novaCategoria" value="<?php echo $dadosJogo->categoria; ?>">
        <input type="submit" class="btn btn-primary m-3" value="enviar">
        <span id="mensagem">
            <?php
            if (isset($_GET['msgErro'])) {
                echo $_GET['msgErro'];
            }
            ?>
        </span>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>