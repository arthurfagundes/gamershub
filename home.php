<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #555;
        }

        nav {
            background: black;
            height: 80px;
            width: 100%;
        }

        img.logo {
            color: white;
            font-size: 35px;
            line-height: 80px;
            padding: 0 20px;
            font-weight: bold;
        }

        nav ul {
            float: right;
            margin-right: 20px;
        }

        nav ul li {
            display: inline-block;
            line-height: 80px;
            margin: 0 5px;
        }

        nav ul li a {
            color: white;
            font-size: 17px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
        }

        a.active,
        a:hover {
            background: gray;
            transition: .5s;
        }

        .checkbtn {
            font-size: 24px;
            color: white;
            float: right;
            line-height: 80px;
            margin-right: 20px;
            cursor: pointer;
            display: none;
        }

        #check {
            display: none;
        }

        @media (max-width: 925px) {
            img.logo {
                font-size: 30px;
                padding-left: 20px;
            }

            nav ul li a {
                font-size: 16px;
            }
        }

        @media (max-width: 858px) {
            .checkbtn {
                display: block;
            }

            nav ul {
                display: flex;
                flex-direction: column;
                position: fixed;
                width: 100%;
                height: 100vh;
                background: #2c3e50;
                top: 80px;
                left: -100%;
                text-align: center;
                transition: all .5s;
            }

            nav ul li {
                display: block;
                line-height: 30px;
            }

            nav ul li a {
                font-size: 20px;
                display: block;
                padding: 15px 0;
            }

            a:hover,
            a.active {
                background: none;
                color: #0082e6;
            }

            #check:checked~ul {
                left: 0;
            }
        }

        section {
            position: relative;
            background: #f2f2f2;
            padding: 20px;
            text-align: center;
            margin: 20px;
            border-radius: 8px;
        }

        section h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .publicar {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        textarea {
            width: calc(70% - 20px); /* Ajuste para deixar espaço para o botão */
            max-width: 600px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            box-sizing: border-box;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 48px;
            margin-right: 40%;
        }

        button:hover {
            background-color: #45a049;
        }

        .post {
            background-color: white;
            border-radius: 8px;
            padding: 10px;
            margin-top: 20px;
            display: flex;
            flex-direction: column; 
            align-items: flex-start; 
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            margin-left: 10px;
        }

        .profile-name {
            font-weight: bold;
        }

        .handle {
            color: gray;
            margin-left: 5px;
        }

        .post-content {
            margin-top: 10px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img class="logo" src="./img/logo_semfundo.png" height="80">
        <ul>
            <li><a href="./perfil.php">Perfil</a></li>
            <li><a href="./jogos.php">Jogos</a></li>
            <li><a href="./login.php">Login</a></li>
        </ul>
    </nav>

    <section>
        <div class="publicar">
            <textarea name="novidade" id="novidade" cols="30" rows="5" placeholder=" O que você está jogando?..."></textarea>
            <button type="submit">Publicar</button>
        </div>

        <div class="post">
            <div class="profile-info">
                <img class="profile-image" src='./img/ealogo.png' alt="Imagem do Perfil">
                <div>
                    <div class="profile-name">EA Sports</div>
                    <div class="handle">@easports</div>
                </div>
            </div>
            <div class="post-content">
                <p>Acompanhe nossos lançamentos através do site.</p>
                <img class="postage-image" src='./img/postagem-ea.png' alt="Imagem de Postagem">
            </div>
        </div>
    </section>
</body>

</html>
