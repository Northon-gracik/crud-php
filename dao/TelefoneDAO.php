<?php
require_once __DIR__ . '/../config/config.php';

class TelefoneDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        $result = pg_query($this->conn, "SELECT * FROM telefones");
        return pg_fetch_all($result) ?: [];
    }

    public function getById($id) {
        $result = pg_query_params($this->conn, "SELECT * FROM telefones WHERE id = $1", [$id]);
        return pg_fetch_assoc($result) ?: null;
    }

    public function getByPessoaId($pessoa_id) {
        $result = pg_query_params($this->conn, "SELECT * FROM telefones WHERE pessoa_id = $1", [$pessoa_id]);
        return pg_fetch_all($result) ?: [];
    }

    public function create($telefone) {
        $sql = "INSERT INTO telefones (pessoa_id, telefone, descricao) VALUES ($1, $2, $3)";
        return pg_query_params($this->conn, $sql, [$telefone->pessoa_id, $telefone->telefone, $telefone->descricao]);
    }

    public function update($telefone) {
        $sql = "UPDATE telefones SET pessoa_id = $1, telefone = $2, descricao = $3 WHERE id = $4";
        return pg_query_params($this->conn, $sql, [$telefone->pessoa_id, $telefone->telefone, $telefone->descricao, $telefone->id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM telefones WHERE id = $1";
        return pg_query_params($this->conn, $sql, [$id]);
    }
}
?>

