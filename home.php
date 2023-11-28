<?php
    session_start();
    include './config/config.php';
    include './class/CrudUsuario.php';
    include './class/CrudPost.php';
    include './class/CrudComentarios.php'; // Adicionado o arquivo do CrudComentarios
    
    $crudUsuario = new CrudUsuario($db);
    $crudPost = new CrudPost($db);
    $crudComentarios = new CrudComentarios($db); // Instância do CrudComentarios

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
        var_dump($post_id); // Adicione esta linha
        $crudPost->deletarPost($post_id);

        // Redireciona de volta à página principal ou aonde você desejar
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Verificar se o formulário para apagar comentário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletar_comentario'])) {
        $comentario_id = $_POST['comentario_id'];
        $crudComentarios->apagarComentario($comentario_id);

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['comentar'])) {
    $comentario_texto = $_POST['comentario_texto'];
    $comentario_imagem = $_FILES['comentario_imagem']['name'];
    $comentario_usuario_id = $idUsuarioLogado;
    $comentario_post_id = $_POST['post_id'];

    move_uploaded_file($_FILES['comentario_imagem']['tmp_name'], './img/' . $comentario_imagem);

    $crudComentarios->criarComentario($comentario_texto, $comentario_usuario_id, $comentario_post_id, $comentario_imagem);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    }
}

include_once('cabecalhohome.php');
?>

    <section class="publicar">
        <div class="publicacao">
            <?php
            $usuarioLogado = $crudUsuario->buscarPorId($idUsuarioLogado);
            echo"<div class= 'box-image'>";
            echo '<img class="profile-image" src="' . $usuarioLogado['imgperfil'] . '" alt="Imagem do Perfil">';
            echo"<div class='box-profile'>";
            echo '<div class="profile-name">' . $usuarioLogado['nome'] . '</div>';
            echo'</div>';
            echo '</div>';
            ?>

            <form method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" placeholder="Título da postagem...">
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
                    echo '<form method="post" class="deletar-form" onsubmit="return confirm(\'Tem certeza que deseja deletar esta postagem?\');">';
                    echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
                    echo '<button type="submit" name="deletar_post">Deletar</button>';
                    echo '</form>';
                    echo '</div>';

                    echo '<div class="comentarios">';
                    echo '<h3>Comentários</h3>';
        
                    // Exibe os comentários usando o método da classe CrudComentarios
                    $comentarios = $crudComentarios->exibirComentarios($post_id);
        
                    // Dentro do loop que exibe os comentários
                    foreach ($comentarios as $comentario) {
                        $usuarioLogado = $crudUsuario->buscarPorId($idUsuarioLogado);
                        echo '<div class="comentario">';
                        echo '<img class="profile-image" src="' . $idUsuarioLogado['imgperfil'] . '" alt="Imagem do Perfil">';
                        echo '<div class="comentario-info">';
                        echo '<div class="profile-name">' . $idUsuarioLogado['nome'] . '</div>';
                        echo '<p>' . $comentario['texto'] . '</p>';
                        if (!empty($comentario['imagem'])) {
                            echo '<img class="comentario-image" src="./img/' . $comentario['imagem'] . '" alt="Imagem de Comentário">';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
        
                    // Formulário para adicionar comentário
                    echo"<div class='botoes-post'>";
                    echo '<form method="post" enctype="multipart/form-data">';
                    echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
                    echo '<textarea name="comentario_texto" placeholder="Adicione um comentário"></textarea>';
                    echo '<input type="file" name="comentario_imagem" accept="image/*">';
                    echo '<button type="submit" name="comentar">Comentar</button>';
                    echo '</form>';
                    echo"</div>";

                    // // Adicione o formulário e o botão de apagar
                    // echo '<form method="post" class="deletar-comentario-form" onsubmit="return confirm(\'Tem certeza que deseja deletar este comentário?\');">';
                    // echo '<input type="hidden" name="comentario_id" value="' . $comentario['id'] . '">';
                    // echo '<button type="submit" name="deletar_comentario">Apagar Comentário</button>';
                    // echo '</form>';

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