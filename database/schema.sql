banco de dados MysQL para a locadora de filmes
CREATE DATABASE locadora;
CREATE TABLE  usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(200) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NULL
);

CREATE TABLE  filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    ano INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL DEFAULT 10.00,
    quantidade_total INT NOT NULL DEFAULT 1,
    quantidade_disponivel INT NOT NULL DEFAULT 1
);


CREATE TABLE locacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filme_id INT NOT NULL,
    usuario_id INT NOT NULL,
    status VARCHAR(20) DEFAULT 'alugado',
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

INSERT INTO usuarios (email, senha, nome) 
VALUES ('maria.d\'errico@ba.estudante.senai.br', '1234', 'Maria D\'Errico');

INSERT INTO filmes (titulo, genero, ano, preco, quantidade_total, quantidade_disponivel) VALUES 
('Mulherzinhas', 'Drama/Romance', 2019, 8.00, 3, 3), 
('Diário de uma Paixão', 'Romance', 2004, 7.00, 3, 3), 
('Young Hearts', 'Drama/Romance', 2024, 8.50, 2, 2), 
('10 Coisas que Eu Odeio em Você', 'Comédia/Romance', 1999, 7.50, 3, 3), 
('Waves', 'Drama', 2019, 8.00, 2, 2);
