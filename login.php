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
        <title>Login</title>
    </head>
<body>
    <h1>Entrar</h1>

    <form action="" method="post">
        <input type="email" name="email" placeholder="Digite o email">

        <input type="password" name="senha" placeholder="Senha:">

        <input type="submit" value="Entrar">
        
        <input type="button" value="Registrar" 
        onclick="window.location.href='register.php';">
    </form>

</body>
</html>