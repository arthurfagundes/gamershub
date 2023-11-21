<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Document</title>
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
