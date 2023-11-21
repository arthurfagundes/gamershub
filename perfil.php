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
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
        }

        .profile-image {
            max-width: 100px; /* Adjust the size as needed */
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-info p {
            margin: 0;
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
        <div class="profile">
            <img class="profile-image" src="<?php echo $usuario['imgperfil']; ?>" alt="Imagem de Perfil">
            <div class="profile-info">
                <p>Nome: <?php echo $usuario['nome']; ?></p>
                <p>Bio: <?php echo $usuario['bio']; ?></p>
            </div>
        </div>
        <a class="edit-profile-link" href="home.php">Home</a>
        <a class="edit-profile-link" href="editar_perfil.php">Editar Perfil</a>
    </div>

    <div class="details">
        <!-- Outras informações detalhadas aqui -->
    </div>

</body>
</html>
