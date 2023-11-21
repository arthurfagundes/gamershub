<?php
    session_start();
    include './config/config.php';
    include './class/CrudUsuario.php';
    include './class/CrudJogos.php';

    $crudUsuario = new CrudUsuario($db);
    $crudJogos = new CrudJogos($db);

    // Verifica se o usuário é administrador, caso contrário, redireciona para a página principal
    if (!$crudUsuario->verificarAdmin($_SESSION['id'])) {
        header("Location: galeria.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtém os dados do formulário
        $nomeJogo = $_POST['nomeJogo'];
        $nomeDesenvolvedora = $_POST['nomeDesenvolvedora'];
        $genero = $_POST['genero'];
        $plataforma = $_POST['plataforma'];
        $classificacao = $_POST['classificacao'];

        // Processa o envio da imagem
        $imagemJogo = $_FILES['imgperfil'];

        // Verifica se um arquivo foi enviado
        if (!empty($imagemJogo['name'])) {
            // Define o diretório de upload (altere para o seu diretório desejado)
            $uploadDir = './img/';

            // Gera um nome único para o arquivo
            $imagemJogoNome = uniqid() . '_' . $imagemJogo['name'];

            // Caminho completo do arquivo
            $imagemJogoPath = $uploadDir . $imagemJogoNome;

            // Move o arquivo para o diretório de upload
            move_uploaded_file($imagemJogo['tmp_name'], $imagemJogoPath);
        } else {
            // Se nenhum arquivo foi enviado, defina um valor padrão ou trate conforme necessário
            $imagemJogoPath = './img/';
        }

        // Adiciona o jogo usando a classe CrudJogos
        $crudJogos->adicionarJogo($nomeJogo, $nomeDesenvolvedora, $genero, $plataforma, $classificacao, $imagemJogoPath);
        header("refresh:3;url=jogos.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="adicionar_jogo.css">
    <title>Adicionar Jogo</title>

</head>
<body>
    <div class="container">
        <h1>Adicionar Jogo</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="nomeJogo">Nome do Jogo:</label>
            <input type="text" name="nomeJogo" required>

            <label for="nomeDesenvolvedora">Nome da Desenvolvedora:</label>
            <input type="text" name="nomeDesenvolvedora" required>

            <label for="genero">Gênero:</label>
            <input type="text" name="genero" required>

            <label for="plataforma">Plataforma:</label>
            <input type="text" name="plataforma" required>

            <label for="classificacao">Classificação:</label>
            <input type="text" name="classificacao" required>

            <label for="imagemJogo">URL da Imagem do Jogo:</label>
            <input type="file" name="imgperfil">

            <button type="submit">Adicionar Jogo</button>
        </form>
    </div>
</body>
</html>
