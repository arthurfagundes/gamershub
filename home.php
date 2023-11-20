<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Para Você</title>

    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        #top-menu {
            background-color: black;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
            position: fixed;
            z-index: 1001;

        }

        #top-menu a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 20px;
            height: 35px;
            position: fixed;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 40px; 
        }

        img {
            width: 120px;
            max-height: 250px;
            object-fit: contain;
        }

        main {
            padding-top: 80px;
            width: 70%;
            margin: 0 auto;
        }

        section {
            background-color: #fff;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="top-menu">
        <a href="#">Perfil</a>
        <a href="#">Mais</a>
        <a href="#">Configurações</a>
    </div>
    <header>
        <img src="./img/G.png" alt="Logo GamersHub">
    </header>
    <main>
        <section class="para-voce">
            <h2>Para você</h2>
            <p>Recomendações de jogos, notícias e muito mais.</p>
        </section>
        <section class="amigos">
            <h2>Amigos</h2>
            <p>Conecte-se com outros jogadores e compartilhe suas experiências.</p>
        </section>
        <section class="jogos-mensais">
            <h2>Jogos mensais</h2>
            <ul>
                <li>WRC 8 FIA World Rally Championship</li>
                <li>WRC 9</li>
            </ul>
        </section>
    </main>
    <footer>
        <p>Copyright © 2023 GamersHub</p>
    </footer>
</body>

</html>
