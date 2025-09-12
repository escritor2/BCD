-- Geração de Modelo físico
-- SQL ANSI 2003 - brModelo.

CREATE DATABASE IF NOT EXISTS empresa_solar;
USE empresa_solar;

-- Tabela de clientes
CREATE TABLE IF NOT EXISTS Clientes (
    ID_Cliente INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Cliente VARCHAR(100)
);

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS Produtos (
    ID_Produto INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Produto VARCHAR(100)
);

-- Tabela de compras
CREATE TABLE IF NOT EXISTS Compra (
    ID_Compra INT AUTO_INCREMENT PRIMARY KEY,
    ID_Produto INT,
    ID_Cliente INT,
    FOREIGN KEY (ID_Produto) REFERENCES Produtos(ID_Produto),
    FOREIGN KEY (ID_Cliente) REFERENCES Clientes(ID_Cliente)
);

-- Tabela de vendedores
CREATE TABLE IF NOT EXISTS Vendedor (
    ID_Vendedor INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Vendedor VARCHAR(100),
    Salario DECIMAL(10,2),
    Faixa_Salarial CHAR(1)
);

-- Inserção de clientes e produtos
INSERT INTO Clientes (Nome_Cliente) VALUES ('Isa');
INSERT INTO Produtos (Nome_Produto) VALUES ('Teclado');

-- Atualização do nome do produto
UPDATE Produtos 
SET Nome_Produto = 'Mouse'
WHERE ID_Produto = 1;

-- Inserção de vendedores com faixas salariais
INSERT INTO Vendedor (Nome_Vendedor, Salario, Faixa_Salarial)
VALUES 
('Carlos Silva', 3200.00, 'A'),
('Fernanda Lima', 4800.00, 'B');

-- Desativa modo seguro para permitir UPDATE
SET SQL_SAFE_UPDATES = 0;

-- Atualização de salário para faixa 'A'
UPDATE Vendedor 
SET Salario = 3150.00
WHERE Faixa_Salarial = 'A';

-- Reativa o modo seguro
SET SQL_SAFE_UPDATES = 1;

-- Consulta dos produtos
SELECT * FROM Produtos;
