<?php
require_once './../modelo/funcoesJogo.php';
require_once './../modelo/funcoesLogin.php';
session_start();

if (empty($_SESSION)) {
    //Não possui nenhuma sessão definida, logo emcaminha para a página principal 
    header("Location: ./../layout/login.php?msg=Usuário não logado");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .welcome {
            text-align: center;
            margin: 5px;
        }

        .search-input {
            width: 43%
        }

        .hideContent {
            display: none;
        }
    </style>
    <script>
        var tabela, registro;
        window.onload = function () {
            tabela = document.getElementById('lista');
            registro = tabela.getElementsByTagName('tr');
        }

        function filter(text) {
            for (let i = 0; i < registro.length; i++) {
                const element = registro[i].innerText.toLowerCase();
                if (!element.includes(text.toLowerCase())) {
                    registro[i].classList.add("hideContent");
                }
                else {
                    registro[i].classList.remove("hideContent");
                }
            }
        }
    </script>
    <title>Colecao de jogos</title>
</head>

<body>
    <h3 class="m-3 welcome">BEM VINDO <strong>
            <?= strtoupper($_SESSION['nome']); ?>
        </strong>!</h3>
    <section class="lista">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Lista de jogos</h1>
                    <div class="container">
                        <?php if (!empty($_GET['msgErro'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_GET['msgErro']; ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($_GET['msg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_GET['msg']; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2 search-input" type="search" placeholder="Search"
                            aria-label="Search" onkeyup="filter(this.value)">
                    </form>
                    <form action="../layout/cadastrarJogo.php" method="get" class="mt-3 mb-3">
                        <input type="submit" class="btn btn-primary" value="Adicionar jogo na colecao">
                    </form>
                    <?php

                    $listaJogos = consultarJogos();

                    //Quantidade de jogos mostrada inicialmente
                    $quantidadeInicial = 5;
                    
                    
                    //Verifica se mandou um 'showMore' via GET
                    if (isset($_GET['showMore'])) {

                        //Quantidade de jogos a serem exibidos, considerando os já exibidos anteriormente
                        $quantidadeExibida = isset($_GET['quantidadeExibida']) ? $_GET['quantidadeExibida'] : $quantidadeInicial;
                        $quantidadeExibida += 5;

                        // Cria a tabela de jogos atualizada com a quantidade desejada
                        criarTabela($listaJogos, $quantidadeExibida);
                    } else {

                        // Exibe a tabela de jogos inicialmente com a quantidade definida
                        criarTabela($listaJogos, $quantidadeInicial);
                        
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>