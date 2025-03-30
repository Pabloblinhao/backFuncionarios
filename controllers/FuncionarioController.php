<?php

require_once __DIR__ . '/../services/FuncionarioService.php';

class FuncionarioController {
    public function criarFuncionario($data) {
        $funcionarioService = new FuncionarioService();

        // Validação de dados
        if (empty($data['nome']) || empty($data['email']) || empty($data['cargo_id'])) {
            http_response_code(400);
            return ["error" => "Nome, email e cargo são obrigatórios"];
        }

        // Verificação se o cargo existe
        $cargoExistente = $funcionarioService->verificarCargo($data['cargo_id']);
        if (!$cargoExistente) {
            http_response_code(400);
            return ["error" => "O cargo informado não existe"];
        }

        return $funcionarioService->criarFuncionario($data['nome'], $data['email'], $data['cargo_id']);
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