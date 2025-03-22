<?php

require_once __DIR__ . '/../services/FuncionarioService.php';


class FuncionarioController{
    public function criarFuncionario($nome, $email, $cargo_id){
        $funcionarioService = new FuncionarioService();

        // Validação de dados
        if (empty($nome) || empty($email) || empty($cargo_id)) {
            return json_encode(['error' => 'Nome, email e cargo são obrigatórios']);
        }

        return $funcionarioService->criarFuncionario($nome, $email, $cargo_id);
    }

    public function listarFuncionarios() {
        $funcionarioService = new FuncionarioService();
        return $funcionarioService->listarFuncionarios();
    }

    public function deletarFuncionario($id) {
        $funcionarioService = new FuncionarioService();
        return $funcionarioService->deletarFuncionario($id);
    }
}
?>