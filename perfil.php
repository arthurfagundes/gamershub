<?php
session_start();
include './config/config.php';
include './class/CrudUsuario.php';

$crudUsuario = new CrudUsuario($db);

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtém o ID do usuário logado diretamente da sessão
$idUsuarioLogado = $_SESSION['id'];

// Busca os dados do usuário pelo ID
$usuario = $crudUsuario->buscarPorId($idUsuarioLogado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/perfil.css">
    <title>Perfil</title>
</head>
<body>
    <div id="tudo">
    <div class="header">
        <img class="background-image" src="<?php echo $usuario['background_img']; ?>" alt="Imagem de Fundo">
        <div class="profile-image">
            <img class="profile-image" src="<?php echo $usuario['imgperfil']; ?>" alt="Imagem de Perfil">
        </div>
        <div>
            <a class="edit-profile-link" href="home.php">Home</a>
            <a class="edit-profile-link" href="editar_perfil.php">Editar Perfil</a>
        </div>
    </div>
    <div class="profile">
                <h5>Nome: <?php echo $usuario['nome']; ?></h5>
                <h5>Bio: <?php echo $usuario['bio']; ?></h5>
    </div>

    <div class="details">
        <!-- Outras informações detalhadas aqui -->
    </div>
    </div>
</body>
</html>
