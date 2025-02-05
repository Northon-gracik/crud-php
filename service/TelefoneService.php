<?php

require_once __DIR__ . '/../dao/TelefoneDAO.php';
require_once __DIR__ . '/../model/Telefone.php';

class TelefoneService {
    private $telefoneDAO;

    public function __construct() {
        $this->telefoneDAO = new TelefoneDAO();
    }

    public function getAll() {
        return $this->telefoneDAO->getAll();
    }

    public function getById($id) {
        return $this->telefoneDAO->getById($id);
    }

    public function getByPessoaId($pessoa_id) {
        return $this->telefoneDAO->getByPessoaId($pessoa_id);
    }

    public function create($data) {
        if (empty(trim($data['pessoa_id'])) || empty(trim($data['telefone'])) || empty(trim($data['descricao']))) {
            return ["error" => "Campos obrigatórios: pessoa_id, telefone, descricao"];
        }

        $telefone = new Telefone(null, $data['pessoa_id'], $data['telefone'], $data['descricao']);
        return $this->telefoneDAO->create($telefone);
    }

    public function update($data, $id) {
        if (empty(trim($data['pessoa_id'])) || empty(trim($data['telefone'])) || empty(trim($data['descricao']))) {
            return ["error" => "Campos obrigatórios: pessoa_id, telefone, descricao"];
        }

        $telefone = new Telefone($id, $data['pessoa_id'], $data['telefone'], $data['descricao']);
        return $this->telefoneDAO->update($telefone);
    }

    public function delete($id) {
        return $this->telefoneDAO->delete($id);
    }
}

