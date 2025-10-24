-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS reserva_equipamentos;
USE reserva_equipamentos;

-- Tabela USUARIO
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email_usuario VARCHAR(100) UNIQUE NOT NULL,
    data_nascimento DATE NOT NULL,
    nome_usuario VARCHAR(100) NOT NULL,
    CPF_usuario VARCHAR(14) UNIQUE NOT NULL
);

-- Tabela EQUIPAMENTO
CREATE TABLE equipamento (
    id_equipamento INT AUTO_INCREMENT PRIMARY KEY,
    nome_equipamento VARCHAR(100) NOT NULL,
    descricao_equipamento VARCHAR(100) NOT NULL,
    status_equipamento ENUM('Disponível', 'Em uso', 'Manutenção', 'Indisponível') DEFAULT 'Disponível',
    categoria_equipamento VARCHAR(50) NOT NULL
);

-- Tabela RESERVA
CREATE TABLE reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_equipamento INT NOT NULL,
    descricao_reserva VARCHAR(150) NOT NULL,
    data_retirada DATETIME NOT NULL,
    data_devolucao DATETIME NOT NULL,
    data_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_equipamento) REFERENCES equipamento(id_equipamento)
);