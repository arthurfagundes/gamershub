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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f0f0 url('<?php echo $usuario['background_img']; ?>') center/cover;
            /* Adiciona a imagem de background escolhida pelo usuário */
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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