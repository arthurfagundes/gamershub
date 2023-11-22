<?php

session_start();
include './config/config.php';
include './class/CrudUsuario.php';
include './class/CrudPost.php';

$crudUsuario = new CrudUsuario($db);
$CrudPost = new CrudPost($db);

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtém o ID do usuário logado diretamente da sessão
$idUsuarioLogado = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&display=swap"         rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Document</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img class="logo" src="./img/logo_semfundo.png" height="80">
        <ul>
            <li><a href="./perfil.php">Perfil</a></li>
            <li><a href="./jogos.php">Jogos</a></li>
            <li><a href="./login.php" onclick="$CrudUsuario.sair()">Sair</a></li>
        </ul>
    </nav>

    <section>
        <div class="publicar">
            <?php
            $usuarioLogado = $crudUsuario->buscarPorId($idUsuarioLogado);

            echo '<img class="profile-image" src="' . $usuarioLogado['imgperfil'] . '" alt="Imagem do Perfil">';
            echo '<div>';
            echo '<div class="profile-name">' . $usuarioLogado['nome'] . '</div>';

            echo '</div>';
            ?>
            <textarea name="novidade" id="novidade" cols="30" rows="5" placeholder=" O que você está jogando?..."></textarea>
            <button type="submit" onclick="publicarPostagem()">Publicar</button>
        </div>
    </section>

    <section class="postagens">
        <h2>Postagens</h2>

        <ul class="postagens-list">
            <?php
            // Obtém todas as postagens da tabela
            $postagens = $CrudPost->listarPostagens();

            foreach ($postagens as $postagem) {
                // Obtém os dados do usuário que fez a postagem
                $usuario = $crudUsuario->buscarPorId($postagem['usuario_id']);

                echo '<li class="postagem">';
                echo '<div class="profile-info">';
                echo '<img class="profile-image" src="' . $usuario['imgperfil'] . '" alt="Imagem do Perfil">';
                echo '<div>';
                echo '<div class="profile-name">' . $usuario['nome'] . '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="post-content">';
                echo '<p>' . $postagem['texto'] . '</p>';
                echo '<img class="postage-image" src="' . $postagem['imagem'] . '" alt="Imagem de Postagem">';
                echo '</div>';
                echo '</li>';
            }
            ?>
        </ul>
    </section>
</body>

</html>
