-- Cria o banco de dados GamersHub
CREATE DATABASE GamersHub;

-- Ative o banco
USE GamersHub;

-- Cria a tabela Usuários
CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  datanasc date NOT NULL,
  senha VARCHAR(255) NOT NULL,
  imgperfil MEDIUMBLOB NOT NULL,
  PRIMARY KEY (id)
);

-- Cria a tabela Jogos
CREATE TABLE jogos (
  id INT NOT NULL AUTO_INCREMENT,
  nomejogo VARCHAR(255) NOT NULL,
  nomedesenvolvedora VARCHAR(255) NOT NULL,
  genero VARCHAR(255) NOT NULL,
  plataforma VARCHAR(255) NOT NULL,
  classificacao INT NOT NULL,
  imgjogo MEDIUMBLOB NOT NULL,
  PRIMARY KEY (id)
);

-- Cria a tabela Resenhas
CREATE TABLE posts (
  id INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(255) NOT NULL,
  texto TEXT NOT NULL,
  usuario_id INT NOT NULL,
  jogo_id INT NOT NULL,
  imagem MEDIUMBLOB NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
  FOREIGN KEY (jogo_id) REFERENCES jogos (id)
);

-- Cria a tabela Comentários
CREATE TABLE comentarios (
  id INT NOT NULL AUTO_INCREMENT,
  texto TEXT NOT NULL,
  usuario_id INT NOT NULL,
  posts_id INT NOT NULL,
  imagem MEDIUMBLOB NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
  FOREIGN KEY (posts_id) REFERENCES posts (id)
);

-- Criat a tabela de republicações
CREATE TABLE reposts (
  id INT NOT NULL AUTO_INCREMENT,
  posts_id INT NOT NULL,
  usuario_id INT NOT NULL,
  data_republicacao DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (posts_id) REFERENCES posts (id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);

-- Criar a tabela de curtidas
CREATE TABLE curtidas (
  id INT NOT NULL AUTO_INCREMENT,
  posts_id INT NOT NULL,
  usuario_id INT NOT NULL,
  data_curtida DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (posts_id) REFERENCES posts (id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);