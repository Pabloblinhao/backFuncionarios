<?php


class Funcionario {
    public $id;
    public $nome;
    public $email;
    public $cargo_id;

    public function __construct($id, $nome, $email, $cargo_id) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cargo_id = $cargo_id;
    }
}
?>