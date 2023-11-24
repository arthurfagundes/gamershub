<?php
session_start();
include './config/config.php';
include './class/CrudUsuario.php';
include './class/CrudJogos.php';

$crudUsuario = new CrudUsuario($db);
$crudJogos = new CrudJogos($db);

include_once('cabecalhojogos.php');
?>


<div class="container">
    <main>
        <h1>Galeria de Jogos</h1>

        <?php
        if ($crudUsuario->verificarAdmin($_SESSION['id'])) {
            echo '<button onclick="window.location.href=\'adicionar_jogo.php\';">Adicionar Jogo</button>';
        }
        ?>

        <div class="galeria">
            <?php
            $jogos = $crudJogos->listarJogos();

            foreach ($jogos as $jogo) {
                echo '<div class="jogo">';
                echo '<h3>' . $jogo['nomejogo'] . '</h3>';

                echo '<img src="' . $jogo['imgjogo'] . '" alt="Imagem do Jogo">';

                echo '<p>Desenvolvedora: ' . $jogo['nomedesenvolvedora'] . '</p>';

                echo '<p>Gênero: ' . $jogo['genero'] . '</p>';

                echo '<p>Classficação: ' . $jogo['classificacao'] . '</p>';

                echo '<p>Plataforma: ' . $jogo['plataforma'] . '</p>';

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