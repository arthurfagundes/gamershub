<?php
session_start();
include './config/config.php';
include './class/CrudUsuario.php';


$crudUsuario = new CrudUsuario($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    if ($crudUsuario->logar($email, $senha)) {
        header("Location: home.php");
        exit();
    } else {
        echo "Login falhou. Verifique suas credenciais.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link href="./css/fontawesome/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <main class="meio">
            <div class="Titulo">
                <img src="./img/logo_semfundo.png" height="150">
                <p>Logue na sua conta</p>
            </div>
            <div class="Logar">
                <form action="" method="post">
                    <img id="logo" src="../img/logo_semfundo.png" alt="">
                    <input type="email" name="email" placeholder="Digite o email">
                    <input type="password" name="senha" placeholder="Senha:">
                    <button type="submit">Logar</button>
                    <button type="button" onclick="window.location.href='register.php';">Registrar</button>
                </form>
                <hr class="divisoria">
            </div>
        </main>
    </div>
</body>
</html>