<?php
require_once './../modelo/jogo.php';
require_once './../modelo/conexao.php';

function cadastrarJogo($nomeJogo, $valor, $categoria)
{
    try {

        //Iniciando a conexão com o DataBase
        $pdo = conectaBanco();

        //sql
        $sql = "INSERT INTO jogo (nomeJogo, valor, categoria) 
                VALUES(:nomeJogo, :valor, :categoria)";

        //Preparando a sql
        $stmt = $pdo->prepare($sql);

        //Definir e Organizar dados para a sql
        $dados = array(
            ':nomeJogo' => $nomeJogo,
            ':valor' => $valor,
            ':categoria' => $categoria
        );

        //Retorna true se o cadastro ocorrreu corretamente
        if ($stmt->execute($dados)) {
            return true;
        }

    } catch (PDOException $e) {
        die($e->getMessage());
        return false;
    }
}

function consultarJogos()
{
    try {

        //Iniciando a conexão com o DataBase
        $pdo = conectaBanco();

        //sql
        $sql = "SELECT * FROM jogo ORDER BY id ASC";

        //Preparando a sql
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        //Array com os jogos
        $result = $stmt->fetchAll();

        if ($stmt->rowCount() > 0) {

            return $result;

        } else {

            return null;

        }

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function consultarJogoId($id)
{
    try {

        //Iniciando a conexão com o DataBase
        $pdo = conectaBanco();

        //sql
        $sql = "SELECT * FROM jogo WHERE id = :id";

        //Preparando a sql
        $stmt = $pdo->prepare($sql);

        //Definir e Organizar dados para a sql
        $dados = array(
            ':id' => $id,
        );

        $stmt->execute($dados);

        $result = $stmt->fetch();

        if ($stmt->rowCount() == 1) {

            return $result;

        } else {
            /*Retorna null Caso não tenha nenhum usuário cadastrado com os 
            respectivos email e senha*/
            return null;
        }

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function verificarJogoId($id)
{
    try {

        //Iniciando a conexão com o DataBase
        $pdo = conectaBanco();

        //sql
        $sql = "SELECT * FROM jogo WHERE id = :id";

        //Preparando a sql
        $stmt = $pdo->prepare($sql);

        //Definir e Organizar dados para a sql
        $dados = array(
            ':id' => $id,
        );

        $stmt->execute($dados);

        if ($stmt->rowCount() == 1) {

            return true;

        } else {
            /*Retorna null Caso não tenha nenhum usuário cadastrado com os 
            respectivos email e senha*/
            return false;
        }

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function listarJogoId($id)
{
    if (consultarJogoId($id) != null) {

        $result = consultarJogoId($id);

        //Criando um objeto e setando informacões nele
        $jogo = new Jogo();
        $jogo->id = $result['id'];
        $jogo->nomeJogo = $result['nomejogo'];
        $jogo->valor = $result['valor'];
        $jogo->categoria = $result['categoria'];

        return $jogo;
    }
    return null;
}
function apagarJogo($id)
{
    try {
        //Consulta para ver se existe algum jogo com esse id
        if (verificarJogoId($id)) {

            //Iniciando a conexão com o DataBase
            $pdo = conectaBanco();

            //sql
            $sql = "DELETE FROM jogo WHERE id = :id";

            //Preparando a sql
            $stmt = $pdo->prepare($sql);

            //Definir e Organizar dados para a sql
            $dados = array(
                ':id' => $id
            );

            //Retorna true se o cadastro ocorrreu corretamente
            $stmt->execute($dados);

            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function alterarJogo($id, $nomeJogo, $valor, $categoria)
{
    try {

        //Iniciando a conexão com o DataBase
        $pdo = conectaBanco();

        //sql
        $sql = "UPDATE
            jogo
          SET
            nomeJogo = :nomeJogo,
            valor = :valor,
            categoria = :categoria
          WHERE
            id = :id";

        //Preparando a sql
        $stmt = $pdo->prepare($sql);

        //Definir e Organizar dados para a sql
        $dados = array(
            ':id' => $id,
            ':nomeJogo' => $nomeJogo,
            ':valor' => $valor,
            ':categoria' => $categoria
        );

        //Retorna true se o cadastro ocorrreu corretamente
        if ($stmt->execute($dados)) {
            return true;
        }

    } catch (PDOException $e) {
        die($e->getMessage());
        return false;
    }
}

//Criar a tabela de jogos
function criarTabela($listaJogos, $quantidade = 5)
{
    echo '<table class="table table-striped">';
    echo '<thead><tr>
    <th>Id</th>
    <th>Nome</th>
    <th>Valor</th>
    <th>Categoria</th>
    <th>Editar</th>
    <th>Excluir</th></thead>';

    echo '<tbody id="lista">';
    if (!empty($listaJogos)) {

        for ($i = 0; $i < $quantidade; $i++) {
            // Verifica se o jogo existe na lista de jogos
            if (isset($listaJogos[$i])) {
                $jogo = $listaJogos[$i];
                echo '<tr>';
                echo '<td>' . $jogo['id'] . '</td>';
                echo '<td>' . $jogo['nomejogo'] . '</td>';
                echo '<td>' . $jogo['valor'] . '</td>';
                echo '<td>' . $jogo['categoria'] . '</td>';
                echo "<td><a href=\"./../layout/alterarJogo.php?idEditar=" . $jogo['id'] . "\"
                        class=\"btn btn-secondary\">Editar</a></td>
                    <td><a href=\"./../controlador/jogoController.php?idExcluir=" . $jogo['id'] . "\"
                        class=\"btn btn-danger\">Excluir</a></td>
                </tr>";
            }

        }


        echo '</tbody>';
        echo '</table>';

        // Exibe o botão "Mostrar Mais" apenas se houver mais jogos para apresentar
        if ($quantidade < count($listaJogos)) {

            echo '<button class=\"btn btn-primary\" onclick="showMore(' . $quantidade . ')">+</button>';

        }

    } else {

        echo '<td colspan="2">Sem jogos cadastrados</td>';
        echo '</tbody>';
        echo '</table>';

    }

    echo '<script>
            function showMore(quantidadeExibida) {
                window.location.href = "?showMore=true&quantidadeExibida=" + quantidadeExibida;
            }
          </script>';
}
?>