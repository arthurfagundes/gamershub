<?php
session_start();
include './config/config.php';
include './class/CrudUsuario.php';
include './class/CrudJogos.php';

$crudUsuario = new CrudUsuario($db);
$crudJogos = new CrudJogos($db);

include_once('cabecalho.php');
?>


<div class="container">
    <main>
        <h1>Galeria de Jogos</h1>

        <?php
        // Verifica se o usuário é administrador para exibir o botão de adicionar jogo
        if ($crudUsuario->verificarAdmin($_SESSION['id'])) {
            echo '<button onclick="window.location.href=\'adicionar_jogo.php\';">Adicionar Jogo</button>';
        }
        ?>

        <div class="galeria">
            <?php
            // Obtém a lista de jogos do banco de dados
            $jogos = $crudJogos->listarJogos();

            // Exibe a galeria de jogos
            foreach ($jogos as $jogo) {
                echo '<div class="jogo">';
                echo '<h3>' . $jogo['nomejogo'] . '</h3>';

                // Exibe a imagem do jogo
                echo '<img src="' . $jogo['imgjogo'] . '" alt="Imagem do Jogo">';

                // Exibe o nome da desenvolvedora
                echo '<p>Desenvolvedora: ' . $jogo['nomedesenvolvedora'] . '</p>';

                // Exibe o gênero do jogo
                echo '<p>Gênero: ' . $jogo['genero'] . '</p>';

                // Adicione outros detalhes do jogo conforme necessário

                // Verifica se o usuário é administrador para exibir o botão de editar jogo
                if ($crudUsuario->verificarAdmin($_SESSION['id'])) {
                    echo '<button onclick="window.location.href=\'editar_jogo.php?id=' . $jogo['id'] . '\';">Editar Jogo</button>';
                }

                echo '</div>';
            }
            ?>

        </div>
    </main>
</div>

</body>

</html>