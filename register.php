<<?php
include_once "./class/DataBase.php";
include_once "./class/CrudUsuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $database = new DataBase();
    $db = $database->getConnection();
    $crudUsuario = new CrudUsuario($db);

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $datanasc = $_POST["datanasc"];
    $senha = $_POST["senha"];
    $comfirme_senha = $_POST["comfirme_senha"];

    $crudUsuario->registrar($nome, $email, $datanasc, $senha, $comfirme_senha);
    echo("Registrado com sucesso");
    header("Refresh: 3; login.php");
} else {
    echo("Dados errados, tente novamente");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
</head>
<body>
    <h2>Registro de Usuário</h2>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="datanasc">Data de Nascimento:</label>
        <input type="date" name="datanasc" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <label for="comfirme_senha">Confirme a Senha:</label>
        <input type="password" name="comfirme_senha" required><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>

