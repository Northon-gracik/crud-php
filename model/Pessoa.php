<?php
class Pessoa {
    public $id;
    public $nome;
    public $cpf;
    public $rg;
    public $cep;
    public $logradouro;
    public $complemento;
    public $setor;
    public $cidade;
    public $uf;
    public $telefones = []; // Lista de telefones

    public function __construct($id, $nome, $cpf, $rg, $cep, $logradouro, $complemento, $setor, $cidade, $uf, $telefones = []) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->complemento = $complemento;
        $this->setor = $setor;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->telefones = $telefones;
    }
}

?>

