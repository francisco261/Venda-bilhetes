-- Tabela para gerir os acessos e contas (US1)
CREATE TABLE utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_completo TEXT NOT NULL,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    tipo_perfil TEXT NOT NULL
);

-- Tabela para os eventos criados pelo gestor (US2)
CREATE TABLE eventos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_evento TEXT NOT NULL,
    data_hora TEXT NOT NULL,
    lotacao_maxima INTEGER NOT NULL,
    preco_bilhete REAL NOT NULL
);

-- Tabela para registar a venda de bilhetes (US3)
CREATE TABLE compras_bilhetes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_utilizador INTEGER,
    id_evento INTEGER,
    data_compra TEXT NOT NULL,
    FOREIGN KEY(id_utilizador) REFERENCES utilizadores(id),
    FOREIGN KEY(id_evento) REFERENCES eventos(id)
);
