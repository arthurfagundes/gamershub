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
    $id = $_POST['id'];
    $nomeJogo = $_POST['nomeJogo'];
    $nomeDesenvolvedora = $_POST['nomeDesenvolvedora'];
    $genero = $_POST['genero'];
    $plataforma = $_POST['plataforma'];
    $classificacao = $_POST['classificacao'];

    // Processa o envio da imagem
    $imagemJogo = $_FILES['imagemJogo'];

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

    // Atualiza o jogo usando a classe CrudJogos
    $crudJogos->atualizarJogo($id, $nomeJogo, $nomeDesenvolvedora, $genero, $plataforma, $classificacao, $imagemJogoPath);
    header("refresh:3;url=jogos.php");
    exit();
} else {
    // Obtém o ID do jogo a ser editado
    $idJogo = $_GET['id'];

    // Obtém as informações do jogo
    $jogo = $crudJogos->getJogoById($idJogo);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="seu_estilo.css">
    <title>Editar Jogo</title>

    <style>
    body {
        margin: 0;
        background-color: #555;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        background-color: #555;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    h1 {
        color: #fff;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        color: #fff;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #fff;
        border-radius: 15px;
        background-color: transparent;
        color: #fff;
        box-sizing: border-box;
    }

    button {
        width: 50%;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #fff;
        border-radius: 15px;
        cursor: pointer;
        font-family: 'Roboto', sans-serif;
        background-color: transparent;
        color: #fff;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>    

</head>
<body>
    <div class="container">
        <h1>Editar Jogo</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $jogo['id']; ?>">

            <label for="nomeJogo">Nome do Jogo:</label>
            <input type="text" name="nomeJogo" value="<?php echo $jogo['nomejogo']; ?>" required>

            <label for="nomeDesenvolvedora">Nome da Desenvolvedora:</label>
            <input type="text" name="nomeDesenvolvedora" value="<?php echo $jogo['nomedesenvolvedora']; ?>" required>

            <label for="genero">Gênero:</label>
            <input type="text" name="genero" value="<?php echo $jogo['genero']; ?>" required>

            <label for="plataforma">Plataforma:</label>
            <input type="text" name="plataforma" value="<?php echo $jogo['plataforma']; ?>" required>

            <label for="classificacao">Classificação:</label>
            <input type="text" name="classificacao" value="<?php echo $jogo['classificacao']; ?>" required>

            <label for="imagemJogo">URL da Imagem do Jogo:</label>
            <input type="file" name="imagemJogo">

            <button type="submit">Atualizar Jogo</button>
        </form>
    </div>
</body>
</html>