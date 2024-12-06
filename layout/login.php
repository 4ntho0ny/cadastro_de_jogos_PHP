<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        input {
            margin: 5px;
        }

        h1 {
            text-align: center;
        }

        #mensagem {
            color: red;
        }
    </style>
    <title>Página de acesso à biblioteca</title>
</head>

<body>
    <h1>Login</h1>
    <form action="../controlador/loginController.php" method="post">
        <label>Login</label>
        <input type="text" name="email" id="">
        <label>Senha</label>
        <input type="password" name="senha" id="">
        <input type="submit" name="enviarDados" value="Submit">
        <span id="mensagem">
            <?php
            if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            }
            ?>
        </span>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>