-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS livraria;
USE livraria;

-- modelo fisico do brmodelo

CREATE TABLE Autores (
    Codigo_autores INT NOT NULL PRIMARY KEY,
    Nome VARCHAR(150),
    Nacionalidade VARCHAR(50),
    Data_nascimento DATE
);

CREATE TABLE Editoras (
    -- Id_editora INT NOT NULL PRIMARY KEY, -- Opção ideal
    Nome_editora VARCHAR(100) NOT NULL PRIMARY KEY, -- Mantido conforme seu código original
    Endereco VARCHAR(200),
    Contato VARCHAR(100),
    Telefone VARCHAR(15),
    Cidade VARCHAR(50), -- Tipo de dado corrigido
    Cnpj VARCHAR(50) UNIQUE -- CNPJ deve ser único
);

-- 3. Tabela CLIENTES
-- O CPF deve ser a Chave Primária
CREATE TABLE Clientes (
    Cpf VARCHAR(11) NOT NULL PRIMARY KEY, -- CPF como PK
    Nome_cliente VARCHAR(150),
    Email VARCHAR(100) UNIQUE,
    Telefone VARCHAR(15),
    Data_nascimento DATE
);

CREATE TABLE Livros (
    Codigo_livro INT NOT NULL PRIMARY KEY,
    Titulo VARCHAR(200), -- Título é importante, adicionei
    Genero VARCHAR(50),
    Preco DECIMAL(10, 2), -- Tipo decimal com precisão
    Quantidade INT
);

CREATE TABLE Vendas (
    Codigo_venda INT NOT NULL PRIMARY KEY,
    Cpf_cliente VARCHAR(11) NOT NULL, -- FK corrigida (usando o PK da tabela Clientes)
    Data_venda DATE,
    Valor_total DECIMAL(10, 2),
    
    FOREIGN KEY (Cpf_cliente) REFERENCES Clientes (Cpf)
);


CREATE TABLE Escrito (
    Codigo_autores INT NOT NULL,
    Codigo_livro INT NOT NULL,
    
    PRIMARY KEY (Codigo_autores, Codigo_livro), -- Chave primária composta
    FOREIGN KEY(Codigo_autores) REFERENCES Autores (Codigo_autores),
    FOREIGN KEY(Codigo_livro) REFERENCES Livros (Codigo_livro)
);

CREATE TABLE Publicado (
    Nome_editora VARCHAR(100) NOT NULL, -- Usando o PK da Editoras
    Codigo_livro INT NOT NULL,
    
    PRIMARY KEY (Nome_editora, Codigo_livro),
    FOREIGN KEY(Nome_editora) REFERENCES Editoras (Nome_editora),
    FOREIGN KEY(Codigo_livro) REFERENCES Livros (Codigo_livro)
);

CREATE TABLE Contem (
    Codigo_venda INT NOT NULL,
    Codigo_livro INT NOT NULL,
    Quantidade_vendida INT NOT NULL, -- Adicionado para registrar quantos de cada livro foram vendidos
    
    PRIMARY KEY (Codigo_venda, Codigo_livro), -- Chave primária composta
    FOREIGN KEY(Codigo_venda) REFERENCES Vendas (Codigo_venda),
    FOREIGN KEY(Codigo_livro) REFERENCES Livros (Codigo_livro) -- CHAVE ESTRANGEIRA CORRIGIDA
);


INSERT INTO Autores (Codigo_autores, Nome, Nacionalidade, Data_nascimento) VALUES
(1, 'Machado de Assis', 'Brasileiro', '1839-06-21'),
(2, 'Agatha Christie', 'Britânica', '1890-09-15'),
(3, 'Yuval Noah Harari', 'Israelense', '1976-02-24');


INSERT INTO Editoras (Nome_editora, Endereco, Contato, Telefone, Cidade, Cnpj) VALUES
('Companhia das Letras', 'Rua A, 123', 'Joana Silva', '11987654321', 'São Paulo', '11111111000100'),
('Rocco', 'Rua B, 456', 'Pedro Costa', '21998765432', 'Rio de Janeiro', '22222222000100');

INSERT INTO Clientes (Cpf, Nome_cliente, Email, Telefone, Data_nascimento) VALUES
('11111111111', 'Ana Souza', 'ana@email.com', '19911111111', '1985-10-20'),
('22222222222', 'Bento Oliveira', 'bento@email.com', '19922222222', '1992-04-12');


INSERT INTO Livros (Codigo_livro, Titulo, Genero, Preco, Quantidade) VALUES
(10, 'Dom Casmurro', 'Romance Clássico', 45.50, 50),
(20, 'E Não Sobrou Nenhum', 'Mistério', 35.00, 30),
(30, 'Sapiens: Uma Breve História', 'Não-Ficção', 90.00, 15);

INSERT INTO Escrito (Codigo_autores, Codigo_livro) VALUES
(1, 10),
(2, 20),
(3, 30);

INSERT INTO Publicado (Nome_editora, Codigo_livro) VALUES
('Companhia das Letras', 10), 
('Rocco', 20), 
('Companhia das Letras', 30); 

INSERT INTO Vendas (Codigo_venda, Cpf_cliente, Data_venda, Valor_total) VALUES
(100, '11111111111', NOW(), 125.00),
(101, '22222222222', NOW(), 35.00); 


INSERT INTO Contem (Codigo_venda, Codigo_livro, Quantidade_vendida) VALUES
(100, 10, 1), -- Venda 100: 1 Dom Casmurro
(100, 30, 1), -- Venda 100: 1 Sapiens
(101, 20, 1); -- Venda 101: 1 E Não Sobrou Nenhum


SELECT L.Titulo, A.Nome AS Nome_Autor, L.Preco
FROM Livros L
JOIN Escrito E ON L.Codigo_livro = E.Codigo_livro
JOIN Autores A ON E.Codigo_autores = A.Codigo_autores
ORDER BY L.Titulo;

SELECT L.Titulo, SUM(C.Quantidade_vendida) AS Total_Vendido
FROM Livros L
JOIN Contem C ON L.Codigo_livro = C.Codigo_livro
GROUP BY L.Titulo
ORDER BY Total_Vendido DESC;


SELECT DISTINCT C.Nome_cliente, C.Email
FROM Clientes C
JOIN Vendas V ON C.Cpf = V.Cpf_cliente
ORDER BY C.Nome_cliente;


UPDATE Clientes
SET Email = 'ana.nova@corp.com'
WHERE Cpf = '11111111111';


UPDATE Livros
SET Preco = 95.00
WHERE Codigo_livro = 30;


DELETE FROM Autores
WHERE Codigo_autores = 3; 


DELETE FROM Escrito WHERE Codigo_autores = 3;
DELETE FROM Autores WHERE Codigo_autores = 3; 


DELETE FROM Contem WHERE Codigo_venda = 101; 
DELETE FROM Vendas WHERE Codigo_venda = 101; 