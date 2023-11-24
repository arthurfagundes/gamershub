<?php
session_start();
include './config/config.php';
include './class/CrudUsuario.php';
include './class/CrudPostPerfil.php';

$crudUsuario = new CrudUsuario($db);
$crudPostPerfil = new CrudPostPerfil($db);

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
    <nav>
        <a class="homelogo" href="./home.php">
            <img class="logo" src="./img/logo_semfundo.png" height="80">
        </a>
        <ul>
            <li><a href="./home.php">Home</a></li>
            <li><a href="./jogos.php">Jogos</a></li>
            <li><a href="./login.php" onclick="$CrudUsuario.sair()">Sair</a></li>
        </ul>
    </nav>
    <div id="tudo">
        <div class="header">
            <img class="background-image" src="<?php echo $usuario['background_img']; ?>" alt="Imagem de Fundo">
            <div class="profile-image">
                <img class="profile-image" src="<?php echo $usuario['imgperfil']; ?>" alt="Imagem de Perfil">
            </div>
            <div>
                <a class="edit-profile-link" href="editar_perfil.php">Editar Perfil</a>
            </div>
        </div>
        <div class="profile">
            <h5>Nome: <?php echo $usuario['nome']; ?></h5>
            <h5>Bio: <?php echo $usuario['bio']; ?></h5>
        </div>

        <section class="postagens">
            <h2>Postagens</h2>

            <ul class="postagens-list">
                <?php
                // Verifica se a instância da classe CrudPost foi criada com sucesso
                if ($crudPostPerfil instanceof CrudPostPerfil) {
                    $postagens = $crudPostPerfil->listarPostagens();

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
                        echo '<img class="postage-image" src="./img/' . $postagem['imagem'] . '" alt="Imagem de Postagem">';
                        echo '</div>';

                        // Adicionar botões e contadores
                        echo '<div class="interactions">';
                        echo '<button class="btn-like">Curtir</button>';
                        echo '<span class="like-count">' . $postagem['curtidas'] . ' curtidas</span>';
                        echo '<button class="btn-comment">Comentar</button>';
                        echo '<button class="btn-share">Compartilhar</button>';
                        echo '</div>';

                        echo '</li>';
                    }
                } else {
                    echo "Erro ao criar a instância da classe CrudPost.";
                }
                ?>
            </ul>
        </section>
        <div class="details">
            <!-- Outras informações detalhadas aqui -->
        </div>
    </div>
</body>

</html>