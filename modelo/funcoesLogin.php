<?php
require_once '../modelo/conexao.php';

function autenticarUsuario($email, $senha)
{
    try {

        //Iniciando a conexão com o DataBase
        $pdo = conectaBanco();

        //sql
        $sql = "SELECT id, nome, email FROM usuario WHERE email = :email AND senha = :senha";

        //Preparando a sql
        $stmt = $pdo->prepare($sql);

        //Definir e Organizar dados para a sql
        $dados = array(
            ':email' => $email,
            ':senha' => md5($senha)
        );

        $stmt->execute($dados);

        //Array com os dados do usuário
        $result = $stmt->fetch();

        //Verificando se existe algum usuario com o mesmo email e senha
        if ($stmt->rowCount() == 1) {
            //Retorna um array com os dados do usuário
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

?>