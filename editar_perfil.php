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

// Verifica se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $bio = $_POST['bio'];

    // Verifica se um arquivo de imagem foi enviado
    if (!empty($_FILES['imgperfil']['name'])) {
        $imgperfil_tmp = $_FILES['imgperfil']['tmp_name'];
        $imgperfil_nome = basename($_FILES['imgperfil']['name']);
        $imgperfil_destino = './img/' . $imgperfil_nome;

        // Move o arquivo temporário para o diretório de destino
        if (move_uploaded_file($imgperfil_tmp, $imgperfil_destino)) {
            // Atualiza o campo imgperfil no banco de dados com o caminho da imagem
            $imgperfil = 'img/' . $imgperfil_nome;
            $editarSucesso = $crudUsuario->editarPerfil($idUsuarioLogado, $nome, $imgperfil, $bio, $usuario['background_img']);
        } else {
            echo "Erro ao fazer o upload da imagem.";
            exit();
        }
    } else {
        // Se nenhum arquivo foi enviado, continua com a edição sem alterar a imagem
        $editarSucesso = $crudUsuario->editarPerfil($idUsuarioLogado, $nome, $usuario['imgperfil'], $bio, $usuario['background_img']);
    }

    // Verifica se um arquivo de imagem de background foi enviado
    if (!empty($_FILES['background_img']['name'])) {
        $background_img_tmp = $_FILES['background_img']['tmp_name'];
        $background_img_nome = basename($_FILES['background_img']['name']);
        $background_img_destino = './img/' . $background_img_nome;

        // Move o arquivo temporário para o diretório de destino
        if (move_uploaded_file($background_img_tmp, $background_img_destino)) {
            // Atualiza o campo background_img no banco de dados com o caminho da imagem
            $background_img = 'img/' . $background_img_nome;
            $editarSucesso = $crudUsuario->editarPerfil($idUsuarioLogado, $nome, $imgperfil, $bio, $background_img);
        } else {
            echo "Erro ao fazer o upload da imagem de background.";
            exit();
        }
    } else {
        // Se nenhum arquivo foi enviado, continua com a edição sem alterar a imagem de background
        $editarSucesso = $crudUsuario->editarPerfil($idUsuarioLogado, $nome, $usuario['imgperfil'], $bio, $usuario['background_img']);
    }

    if ($editarSucesso) {
        header("Location: perfil.php");
        exit();
    } else {
        echo "Erro ao editar o perfil.";
    }
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/editar_perfil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Editar Perfil</title>
</head>
<body>
    <h1>Editar Perfil</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>">

        <label for="imgperfil">Imagem de Perfil:</label>
        <input type="file" name="imgperfil">

        <label for="background_img">Imagem de Fundo:</label>
        <input type="file" name="background_img">

        <label for="bio">Biografia:</label>
        <textarea name="bio"><?php echo $usuario['bio']; ?></textarea>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>