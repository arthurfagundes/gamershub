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
    <html lang="PT-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/cadastrar.css">
        <link href="fontawesome/css/all.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <title>GamersHub - Cadastro</title>
    </head>
    <body>
        <div class="container">
            <!-- Main-->
            <main class="meio">
                <div class="Titulo">
                    <img src="./img/logo_semfundo.png" height="150">
                    <p>Crie sua conta</p>
                </div>
                <div class="Logar">
                    <form>
                    <input type="text" id="username" name="username" placeholder="Nome de usuário" required>
                    <input placeholder="Data de nascimento" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" required><br>                   
                    <input type="text" id="email" name="email" placeholder="Digite seu e-mail" required>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                    <input type="password" id="rpassword" name="rpassword" placeholder="Repita sua senha" required>
                    <button type="submit">CADASTRAR</button>
                    </form>
                    <hr class="divisoria">
                </div>
            </main>
            <!-- Rodape-->
            <!-- <footer class="rodape">
                <div class="Git">
                    <a href="">Feito por Dev</a>
                </div>
                <div class="Redes">
                    <i class="fa-brands fa-whatsapp" style="color: #00129e;"></i>
                    <i class="fa-brands fa-instagram" style="color: #00129e;"></i>
                    <i class="fa-brands fa-tiktok fa" style="color: #00129e;"></i>
                </div>
            </footer> -->
        </div>
    </body>
    </html>

