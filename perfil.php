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
    <title>Perfil</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            padding: 10px;
            position: relative;
            width: 75%;
            height: 100px;
            align-items: center;
            justify-content: space-between;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Cobrir totalmente o espaço do elemento */
            z-index: -1; /* Coloca a imagem de fundo atrás do conteúdo do cabeçalho */
        }

        .profile-image {
            max-width: 70px;
        }       

        .profile {
            background: grey;
            border-color: black;
            padding: 10px;
            position: relative;
            width: 75%;
            height: 50px;
        }

        .profile h5 {
            margin: 2px;
        }

        .edit-profile-link {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
        }

        .details {
            display: flex;
            margin: 20px 0;
        }

        .details div {
            margin-right: 20px;
        }
    </style>
</head>
<body>
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
</body>
</html>
