<?php
require_once __DIR__ . '/../config/config.php';

class PessoaDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }


    public function getAll() {
        $sql = "SELECT p.id, p.nome, p.cpf, p.rg, p.cep, p.logradouro, p.complemento, p.setor, p.cidade, p.uf, 
                       COALESCE(array_to_json(array_agg(t) FILTER (WHERE t.id IS NOT NULL)), '[]') as telefones 
                FROM pessoas p
                LEFT JOIN telefones t ON p.id = t.pessoa_id
                GROUP BY p.id";
        $result = pg_query($this->conn, $sql);
        if (!$result) {
            return [];
        }
        return pg_fetch_all($result) ?: [];
    }

    public function getById($id) {
        $sql = "SELECT p.id, p.nome, p.cpf, p.rg, p.cep, p.logradouro, p.complemento, p.setor, p.cidade, p.uf, 
                       COALESCE(array_to_json(array_agg(t) FILTER (WHERE t.id IS NOT NULL)), '[]') as telefones 
                FROM pessoas p
                LEFT JOIN telefones t ON p.id = t.pessoa_id
                WHERE p.id = $1
                GROUP BY p.id";
        $result = pg_query_params($this->conn, $sql, [$id]);
        return pg_fetch_all($result) ?: [];
    }

    public function create($pessoa) {
        $sql = "INSERT INTO pessoas (nome, cpf, rg, cep, logradouro, complemento, setor, cidade, uf) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";
        echo $sql . "\n";
        echo "Params: " . print_r([$pessoa->nome, $pessoa->cpf, $pessoa->rg, $pessoa->cep, $pessoa->logradouro, $pessoa->complemento, $pessoa->setor, $pessoa->cidade, $pessoa->uf], true) . "\n";
        return pg_query_params($this->conn, $sql, [$pessoa->nome, $pessoa->cpf, $pessoa->rg, $pessoa->cep, $pessoa->logradouro, $pessoa->complemento, $pessoa->setor, $pessoa->cidade, $pessoa->uf]);
    }

    public function update($pessoa) {
        $sql = "UPDATE pessoas SET nome = $1, cpf = $2, rg = $3, cep = $4, logradouro = $5, complemento = $6, setor = $7, cidade = $8, uf = $9 WHERE id = $10";
        
        return pg_query_params($this->conn, $sql, [$pessoa->nome, $pessoa->cpf, $pessoa->rg, $pessoa->cep, $pessoa->logradouro, $pessoa->complemento, $pessoa->setor, $pessoa->cidade, $pessoa->uf, $pessoa->id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM pessoas WHERE id = $1";
        return pg_query_params($this->conn, $sql, [$id]);
    }
}
?>

