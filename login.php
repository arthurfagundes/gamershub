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
</form>


<?php
session_start();
include './config/config.php';
include './class/CrudUsuario.php';


$user = new CrudUsuario($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    if ($user->logar($email, $senha)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Login falhou. Verifique suas credenciais.";
    }
}
?>

</body>
</html>