CREATE DATABASE livraria;

USE livraria;

CREATE TABLE categorias(
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE livros(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    descricao TEXT,
    categoria_id INT NOT NULL,
    FOREIGN KEY(categoria_id) REFERENCES categorias(id)
);

CREATE TABLE usuarios(
    id int AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL
);