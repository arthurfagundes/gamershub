<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    .hamburger {
  position: fixed;
  z-index: 100;
  top: 1rem;
  right: 1rem;
  padding: 4px;
  border: black solid 1px;
  background: white;
  cursor: pointer;
}

.closeIcon {
  display: none;
}

.menu {
  position: fixed;
  transform: translateY(-100%);
  transition: transform 0.2s;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 99;
  background: black;
  color: white;
  list-style: none;
  padding-top: 4rem;
}

.showMenu {
  transform: translateY(0);
}
  </style>
</head>
<body>
  <ul class="menu">
    <li><a class="menuItem" href="#">Perfil</a></li>
    <li><a class="menuItem" href="#">Mais</a></li>
    <li><a class="menuItem" href="#">Configurações</a></li>
  </ul>
  <button class="hamburger">
    <!-- material icons https://material.io/resources/icons/ -->
    <i class="menuIcon material-icons">menu</i>
    <i class="closeIcon material-icons">close</i>
  </button>
    <script>
        const menu = document.querySelector(".menu");
const menuItems = document.querySelectorAll(".menuItem");
const hamburger= document.querySelector(".hamburger");
const closeIcon= document.querySelector(".closeIcon");
const menuIcon = document.querySelector(".menuIcon");

function toggleMenu() {
  if (menu.classList.contains("showMenu")) {
    menu.classList.remove("showMenu");
    closeIcon.style.display = "none";
    menuIcon.style.display = "block";
  } else {
    menu.classList.add("showMenu");
    closeIcon.style.display = "block";
    menuIcon.style.display = "none";
  }
}

hamburger.addEventListener("click", toggleMenu);
    </script>
</body>
</html>
