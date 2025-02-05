<?php

require_once __DIR__ . '/../dao/PessoaDAO.php';
require_once __DIR__ . '/../model/Pessoa.php';

class PessoaService {
    private $pessoaDAO;

    public function __construct() {
        $this->pessoaDAO = new PessoaDAO();
    }

    public function getAll() {
        $result = $this->pessoaDAO->getAll();
        error_log('getAll method called');
        return $result;
    }

    public function getById($id) {
        return $this->pessoaDAO->getById($id);
    }

    public function create($data) {
        if (empty($data['nome']) || empty($data['cpf']) || empty($data['rg']) || empty($data['cep']) || empty($data['logradouro']) || empty($data['complemento']) || empty($data['setor']) || empty($data['cidade']) || empty($data['uf'])) {
            return ["error" => "Campos obrigatórios: nome, cpf, rg, cep, logradouro, complemento, setor, cidade, uf"];
        }

        $pessoa = new Pessoa(null, $data['nome'], $data['cpf'], $data['rg'], $data['cep'], $data['logradouro'], $data['complemento'], $data['setor'], $data['cidade'], $data['uf']);
        return $this->pessoaDAO->create($pessoa);
    }

    public function update($data, $id) {
        // error_log('update method called with data: ' . print_r($data, true));
        if (empty($data['nome']) || empty($data['cpf']) || empty($data['rg']) || empty($data['cep']) || empty($data['logradouro']) || empty($data['complemento']) || empty($data['setor']) || empty($data['cidade']) || empty($data['uf'])) {
            return ["error" => "Campos obrigatórios: nome, cpf, rg, cep, logradouro, complemento, setor, cidade, uf"];
        }

        $pessoa = new Pessoa($id, $data['nome'], $data['cpf'], $data['rg'], $data['cep'], $data['logradouro'], $data['complemento'], $data['setor'], $data['cidade'], $data['uf']);
        return $this->pessoaDAO->update($pessoa);
    }

    public function delete($id) {
        return $this->pessoaDAO->delete($id);
    }
}

