<?php
class Telefone {
    public $id;
    public $pessoa_id;
    public $telefone;
    public $descricao;

    public function __construct($id, $pessoa_id, $telefone, $descricao) {
        $this->id = $id;
        $this->pessoa_id = $pessoa_id;
        $this->telefone = $telefone;
        $this->descricao = $descricao;
    }
}
?>
