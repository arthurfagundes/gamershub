<?php
    session_start();
    include './config/config.php';
    include './class/CrudUsuario.php';
    include './class/CrudPost.php';

    $crudUsuario = new CrudUsuario($db);
    $crudPost = new CrudPost($db);

    // Verifica se o usuário está logado
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    // Obtém o ID do usuário logado diretamente da sessão
    $idUsuarioLogado = $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém o ID do usuário logado diretamente da sessão
        $idUsuarioLogado = $_SESSION['id'];
    
        // Verifica se os dados do formulário foram recebidos
        if (isset($_POST['titulo'], $_POST['novidade'], $_FILES['imagem']['name'])) {
            $titulo = $_POST['titulo'];
            $texto = $_POST['novidade'];
            $imagem = $_FILES['imagem']['name'];
            $usuario_id = $idUsuarioLogado;
    
            // Move o arquivo para o diretório desejado (ajuste o caminho conforme necessário)
            move_uploaded_file($_FILES['imagem']['tmp_name'], './img/' . $imagem);
    
            // Adiciona a postagem usando o método da classe CrudPost
        $crudPost->adicionarPost($titulo, $texto, $usuario_id, $imagem);

        // Redireciona de volta à página principal ou aonde você desejar
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
        }
    
        // Ação de curtir
    if (isset($_POST['curtir_post'])) {
        $post_id = $_POST['post_id'];
        $crudPost->curtirPost($post_id);

        // Redireciona de volta à página principal ou aonde você desejar
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Ação de deletar
    if (isset($_POST['deletar_post'])) {
        $post_id = $_POST['post_id'];
        $crudPost->deletarPost($post_id);

        // Redireciona de volta à página principal ou aonde você desejar
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>GamersHub</title>
</head>

<body>
    <nav>
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

            <form method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" placeholder="Título da postagem">
                <textarea name="novidade" id="novidade" cols="30" rows="5" placeholder=" O que você está jogando?..."></textarea>
                <input type="file" name="imagem" accept="image/*">
                <button type="submit">Publicar</button>
            </form>
        </div>
    </section>
    
    <section class="postagens">
    <h2>Postagens</h2>

    <ul class="postagens-list">
        <?php
        if ($crudPost instanceof CrudPost) {
            $postagens = $crudPost->listarPostagens();

            foreach ($postagens as $postagem) {
                $usuario = $crudUsuario->buscarPorId($postagem['usuario_id']);
                $post_id = $postagem['id'];

                echo '<li class="postagem" id="postagem-' . $post_id . '">';
                    echo '<div class="profile-info">';
                    echo '<img class="profile-image" src="' . $usuario['imgperfil'] . '" alt="Imagem do Perfil">';
                    echo '<div class="profile-name">' . $usuario['nome'] . '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="post-content">';
                    echo '<p>' . $postagem['texto'] . '</p>';
                    echo '<img class="postage-image" src="./img/' . $postagem['imagem'] . '" alt="Imagem de Postagem">';
                    echo '</div>';

                    echo '<div class="info">';
                    echo '<form method="post" class="curtir-form">';
                    echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
                    echo '<button type="submit" name="curtir_post">Curtir</button>';
                    echo '<span class="curtidas-count">' . $postagem['curtidas'] . ' curtidas</span>';
                    echo '</form>';
                    echo '</div>';

                    echo '<div class="dell">';
                    echo '<form method="post" class="deletar-form">';
                    echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
                    echo '<button type="submit" name="deletar_post">Deletar</button>';
                    echo '</form>';
                    echo '</div>';

                echo '</li>';
            }
        } else {
            echo "Erro ao criar a instância da classe CrudPost.";
        }
        ?>
    </ul>
</section>

</body>

</html>