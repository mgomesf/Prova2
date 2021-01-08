CREATE DATABASE petshop;
USE petshop;
CREATE TABLE especie (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL
);
CREATE TABLE animal (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_especie INTEGER NOT NULL,
    nome VARCHAR(100) NOT NULL,
    nome_dono VARCHAR(100) NOT NULL,
    raca VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    FOREIGN KEY (id_especie) REFERENCES especie(id)
);