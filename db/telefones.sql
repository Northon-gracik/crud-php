CREATE TABLE IF NOT EXISTS telefones (
    id SERIAL PRIMARY KEY,
    pessoa_id INTEGER NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    descricao VARCHAR(50) NOT NULL,
    FOREIGN KEY (pessoa_id) REFERENCES pessoas(id)
);