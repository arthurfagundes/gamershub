<?php
include_once("./cabecalhoperfil.php");
session_start();
include './config/config.php';
include './class/CrudUsuario.php';
include './class/CrudPost.php';
include './class/CrudComentarios.php';

$crudUsuario = new CrudUsuario($db);
$crudPost = new CrudPost($db);
$crudComentarios = new CrudComentarios($db);

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtém o ID do usuário logado diretamente da sessão
$idUsuarioLogado = $_SESSION['id'];

// Busca os dados do usuário pelo ID
$usuario = $crudUsuario->buscarPorId($idUsuarioLogado);

// Busca os posts do usuário
$postsDoUsuario = $crudPost->listarPostagensPorUsuario($idUsuarioLogado);


?>

<div class="Container">
    <div class="perfil">
        <img class="background-image" src="<?php echo $usuario['background_img']; ?>" alt="Imagem de Fundo">
        <div class="profile-image">
            <img class="profile-image" src="<?php echo $usuario['imgperfil']; ?>" alt="Imagem de Perfil">
        </div>
    </div>
    <div class="infoperfil">
        <h5>Nome: <?php echo $usuario['nome']; ?></h5>
        <h5>Bio: <?php echo $usuario['bio']; ?></h5>
        <div>
            <a class="botaoeditarperfil" href="editar_perfil.php">Editar Perfil</a>
        </div>
    </div>

    <div class="postagens-comentarios">
        <div class="posts-do-usuario">
            <h2>Posts do Perfil</h2>
            <ul>
                <?php
                foreach ($postsDoUsuario as $post) {
                    $usuarioPost = $crudUsuario->buscarPorId($post['usuario_id']);

                    echo '<li>';
                    echo '<div class="profile-info">';
                    echo '<img class="profile-image" src="' . $usuarioPost['imgperfil'] . '" alt="Imagem do Perfil">';
                    echo '<div class="profile-name">' . $usuarioPost['nome'] . '</div>';
                    echo '</div>';
                    echo '<p>' . $post['texto'] . '</p>';
                    echo '<img src="./img/' . $post['imagem'] . '" alt="Imagem de Postagem">';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>

        <div class="comentarios-do-usuario">
            <h2>Comentários do Perfil</h2>
            <ul>
                <?php
                $comentariosDoUsuario = $crudComentarios->listarComentariosPorUsuario($idUsuarioLogado);

                foreach ($comentariosDoUsuario as $comentario) {
                    $usuarioComentario = $crudUsuario->buscarPorId($comentario['usuario_id']);

                    echo '<li>';
                    echo '<div class="profile-info">';
                    echo '<img class="profile-image" src="' . $usuarioComentario['imgperfil'] . '" alt="Imagem do Perfil">';
                    echo '<div class="profile-name">' . $usuarioComentario['nome'] . '</div>';
                    echo '</div>';
                    echo '<p>' . $comentario['texto'] . '</p>';
                    if (!empty($comentario['imagem'])) {
                        echo '<img src="./img/' . $comentario['imagem'] . '" alt="Imagem de Comentário">';
                    }
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</body>

</html>