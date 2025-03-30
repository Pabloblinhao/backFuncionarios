<?php

require_once __DIR__ . '/../config/db.php';

class FuncionarioService {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function criarFuncionario($nome, $email, $cargo_id) {
        // Validação de e-mail único
        $stmt = $this->conn->prepare("SELECT id FROM funcionarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            return ["error" => "O email já está em uso"];
        }

        // Inserção do funcionário
        $stmt = $this->conn->prepare("INSERT INTO funcionarios (nome, email, cargo_id) VALUES (?, ?, ?)");
        if ($stmt->execute([$nome, $email, $cargo_id])) {
            return ["success" => "Funcionário cadastrado com sucesso"];
        } else {
            http_response_code(500);
            return ["error" => "Erro ao cadastrar funcionário"];
        }
    }

    public function listarFuncionarios() {
        $stmt = $this->conn->query("SELECT f.id, f.nome, f.email, c.nome AS cargo FROM funcionarios f INNER JOIN cargos c ON f.cargo_id = c.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletarFuncionario($id) {
        $stmt = $this->conn->prepare("DELETE FROM funcionarios WHERE id = ?");
        if ($stmt->execute([$id])) {
            return ["success" => "Funcionário removido com sucesso"];
        } else {
            http_response_code(500);
            return ["error" => "Erro ao remover funcionário"];
        }
    }

    public function verificarCargo($cargo_id) {
        $stmt = $this->conn->prepare("SELECT id FROM cargos WHERE id = ?");
        $stmt->execute([$cargo_id]);
        return $stmt->fetch() ? true : false;
    }
}
?>