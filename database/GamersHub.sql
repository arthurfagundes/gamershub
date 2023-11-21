-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Nov-2023 às 23:44
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gamershub`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `texto` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `imagem` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_curtida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

CREATE TABLE `jogos` (
  `id` int(11) NOT NULL,
  `nomejogo` varchar(255) NOT NULL,
  `nomedesenvolvedora` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `plataforma` varchar(255) NOT NULL,
  `classificacao` int(11) NOT NULL,
  `imgjogo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`id`, `nomejogo`, `nomedesenvolvedora`, `genero`, `plataforma`, `classificacao`, `imgjogo`) VALUES
(1, 'tom clancy`s Rainbow Six Siege', 'Ubisoft', 'FPS', 'PC/Xbox/Psn', 14, 'img/jogorainbowsix.jpeg'),
(4, 'Valorant', 'Riot Games', 'FPS', 'PC', 16, './img/655c422a40f9a_vava.png'),
(5, 'FC24', 'EA Sports', 'Simulador', 'PC/PSN/XBOX', 12, './img/655c42af3ddcb_eafc.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `jogo_id` int(11) NOT NULL,
  `imagem` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reposts`
--

CREATE TABLE `reposts` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_republicacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

CREATE TABLE `seguidores` (
  `id` int(11) NOT NULL,
  `usuario_id_seguidor` int(11) NOT NULL,
  `usuario_id_seguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguindo`
--

CREATE TABLE `seguindo` (
  `id` int(11) NOT NULL,
  `usuario_id_seguido` int(11) NOT NULL,
  `usuario_id_seguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `datanasc` date NOT NULL,
  `senha` varchar(255) NOT NULL,
  `imgperfil` varchar(300) NOT NULL,
  `background_img` varchar(300) NOT NULL,
  `bio` varchar(300) NOT NULL,
  `admin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `datanasc`, `senha`, `imgperfil`, `background_img`, `bio`, `admin`) VALUES
(10, 'arthur', 'arthuurfagundes@gmail.com', '2003-07-02', '$2y$10$WmgAKxgr3QDYn9LVVK8/JuwPo461t5CanWZP1P.foTAj.QCCYqNpC', 'img/Arthur.jpg', '', 'OI SOU O DEV ARTHUR', 0),
(11, 'Txrrorzin', 'luisseverodasilva17@gmail.com', '2003-07-17', '$2y$10$cpyng/fkz9Cyx3l8HmxjNOSpsfyynQNh/DIWc51IWM4DaSVL1L6mu', 'img/neyme.jpeg', 'img/Captura de Tela (102).png', 'OI SOU O LUIS', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `posts_id` (`posts_id`);

--
-- Índices para tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `jogo_id` (`jogo_id`);

--
-- Índices para tabela `reposts`
--
ALTER TABLE `reposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id_seguidor` (`usuario_id_seguidor`),
  ADD KEY `usuario_id_seguido` (`usuario_id_seguido`);

--
-- Índices para tabela `seguindo`
--
ALTER TABLE `seguindo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id_seguido` (`usuario_id_seguido`),
  ADD KEY `usuario_id_seguidor` (`usuario_id_seguidor`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reposts`
--
ALTER TABLE `reposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `seguindo`
--
ALTER TABLE `seguindo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`);

--
-- Limitadores para a tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`jogo_id`) REFERENCES `jogos` (`id`);

--
-- Limitadores para a tabela `reposts`
--
ALTER TABLE `reposts`
  ADD CONSTRAINT `reposts_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `reposts_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`usuario_id_seguidor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguidores_ibfk_2` FOREIGN KEY (`usuario_id_seguido`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `seguindo`
--
ALTER TABLE `seguindo`
  ADD CONSTRAINT `seguindo_ibfk_1` FOREIGN KEY (`usuario_id_seguido`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguindo_ibfk_2` FOREIGN KEY (`usuario_id_seguidor`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
