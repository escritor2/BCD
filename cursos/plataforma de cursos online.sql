create database plataforma_de_cursos_online;
use plataforma_de_cursos_online;

-- Tabela ALUNO
CREATE TABLE Aluno (
    Id_aluno INT NOT NULL PRIMARY KEY,
    Nome VARCHAR(150),
    Email VARCHAR(100) UNIQUE,
    Data_nascimento DATE
);

-- Tabela CURSOS
CREATE TABLE Cursos (
    Id_cursos INT NOT NULL PRIMARY KEY,
    Titulo VARCHAR(100),
    Descricao VARCHAR(500),
    Carga_horaria INT,
    Status VARCHAR(20)
);

CREATE TABLE Inscricoes (
    Id_inscricao INT NOT NULL PRIMARY KEY,
    
    -- Chaves Estrangeiras
    Aluno_id INT NOT NULL,
    Curso_id INT NOT NULL,
    
    Data_inscricao DATETIME NOT NULL,
    
    -- Campos da Avaliação
    Nota DECIMAL(3, 1), 
    Comentario VARCHAR(255),
    
    -- Definição das Chaves Estrangeiras
    FOREIGN KEY (Aluno_id) REFERENCES Aluno (Id_aluno),
    FOREIGN KEY (Curso_id) REFERENCES Cursos (Id_cursos),
    
    -- Restrição de unicidade: Aluno só pode se inscrever uma vez no mesmo curso
    UNIQUE (Aluno_id, Curso_id) 
);

INSERT INTO Aluno (Id_aluno, Nome, Email, Data_nascimento) VALUES
(1, 'Alice Silva', 'alice.silva@email.com', '1998-05-15'),
(2, 'Bruno Costa', 'bruno.costa@email.com', '1993-11-20'),
(3, 'Cintia Lima', 'cintia.lima@email.com', '2001-01-08'),
(4, 'Davi Pereira', 'davi.pereira@email.com', '1990-07-25'),
(5, 'Erica Santos', 'erica.santos@email.com', '1999-03-30');


-- CURSOS (1 inativo, conforme pedido)
INSERT INTO Cursos (Id_cursos, Titulo, Descricao, Carga_horaria, Status) VALUES
(101, 'Introdução ao SQL', 'Fundamentos de Banco de Dados Relacionais.', 20, 'Ativo'),
(102, 'Desenvolvimento Web com Python', 'Construção de APIs e aplicações web.', 60, 'Ativo'),
(103, 'Design Gráfico para Iniciantes', 'Primeiros passos no design e ferramentas.', 30, 'Ativo'),
(104, 'Segurança de Redes', 'Técnicas de proteção e monitoramento.', 80, 'Ativo'),
(105, 'História da Arte Moderna', 'Análise de movimentos e artistas.', 15, 'Inativo'); -- Curso Inativo


-- INSCRIÇÕES (3 avaliação, 2 sem avaliação)
INSERT INTO Inscricoes (Id_inscricao, Aluno_id, Curso_id, Data_inscricao, Nota, Comentario) VALUES
-- 1. Avaliada (Nota 9.5)
(1001, 1, 101, '2024-08-01', 9.5, 'Ótimo curso introdutório, bem didático.'),

(1002, 2, 102, '2024-08-05', 7.8, 'Conteúdo muito bom, mas o ritmo é um pouco lento.'),

(1003, 3, 103, '2024-08-10', 10.0, 'Excelente! Superou as expectativas.'),

(1004, 4, 104, '2024-08-15', NULL, NULL),

(1005, 5, 101, '2024-08-20', NULL, NULL);

-- insercao de dados
UPDATE Aluno
SET Email = 'davi.p.novo@corp.com'
WHERE Id_aluno = 4;


UPDATE Cursos
SET Carga_horaria = 45 -- Aumentando de 30 para 45 horas
WHERE Id_cursos = 103;

UPDATE Aluno
SET Nome = 'Cynthia Lima'
WHERE Id_aluno = 3;

UPDATE Cursos
SET Status = 'Ativo'
WHERE Id_cursos = 105;

UPDATE Inscricoes
SET Nota = 8.5, Comentario = 'Melhorei a nota após revisar o conteúdo.'
WHERE Id_inscricao = 1002;

-- exclusao de dados

UPDATE Inscricoes
SET Nota = NULL, Comentario = NULL
WHERE Id_inscricao = 1003;


DELETE FROM Inscricoes
WHERE Id_inscricao = 1005;

DELETE FROM Cursos
WHERE Id_cursos = 105;

DELETE FROM Aluno
WHERE Id_aluno = 5;

DELETE FROM Inscricoes
WHERE Curso_id = 104;

DELETE FROM Cursos
WHERE Id_cursos = 104;

-- Consultas com Critérios e Agrupamentos

SELECT * FROM Aluno;

SELECT Nome, Email FROM Aluno;


SELECT Titulo, Carga_horaria
FROM Cursos
WHERE Carga_horaria > 30;


SELECT Titulo, Status
FROM Cursos
WHERE Status = 'Inativo';


SELECT Nome, Data_nascimento
FROM Aluno
WHERE Data_nascimento > '1995-12-31'; -- Ou YEAR(Data_nascimento) > 1995


SELECT I.Id_inscricao, A.Nome AS Aluno, C.Titulo AS Curso, I.Nota, I.Comentario
FROM Inscricoes I
JOIN Aluno A ON I.Aluno_id = A.Id_aluno
JOIN Cursos C ON I.Curso_id = C.Id_cursos
WHERE I.Nota > 9;


SELECT COUNT(Id_cursos) AS Total_Cursos
FROM Cursos;


SELECT Titulo, Carga_horaria
FROM Cursos
ORDER BY Carga_horaria DESC
LIMIT 3;

CREATE INDEX idx_aluno_email
ON Aluno (Email);