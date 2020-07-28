CREATE DATABASE livraria;

USE livraria;

CREATE TABLE usuarios(
    id int AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE categorias(
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE livros(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    descricao TEXT,
    categoria_id INT NOT NULL,
    FOREIGN KEY(categoria_id) REFERENCES categorias(id)
);

INSERT INTO usuarios (email, senha) VALUES ('teste@gmail.com', MD5('123'));

INSERT INTO categorias (nome) VALUES ('Java');
INSERT INTO categorias (nome) VALUES ('.NET');
INSERT INTO categorias (nome) VALUES ('PHP');
INSERT INTO categorias (nome) VALUES ('iOS');
INSERT INTO categorias (nome) VALUES ('Android');
INSERT INTO categorias (nome) VALUES ('HTML e CSS');
INSERT INTO categorias (nome) VALUES ('JavaScript');

INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Java 9', 'Rodrigo Turini', 'Interativo, reativo e modularizado', 1);
INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Spring Boot', 'Fernando Boaglio', 'Acelere o desenvolvimento de microsserviços', 1);
INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Algoritmos em Java', 'Guilherme Silveira', 'Busca, ordenação e Análise', 1);
INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Design Patterns com C#', 'Rodrigo Gonçalves', 'Aprenda padrões de projeto com os games', 2);
INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Programação Funcional em .NET', 'Gabriel Schade', 'Explore um novo universo', 2);
INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Programação Web avançada com PHP', 'Flávio Lisboa', 'Construindo software com componentes', 3);
INSERT INTO livros (titulo, autor, descricao, categoria_id) VALUES ('Design Patterns com PHP 7', 'Desenvolva com as melhores soluções', 'Gabriel Anhaia', 3);