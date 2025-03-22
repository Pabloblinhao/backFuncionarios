<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Funcionario.php';


class FuncionarioService {

    public function criarFuncionario($nome, $email, $cargo_id){
        global $pdo;

        // Verificar se o e-mail já existe
        $stmt = $pdo->prepare("SELECT * FROM funcionarios where email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            return json_encode(['Error' => 'Email já cadastrado.']);
        }

        //criar o nobo funcionario
        $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, email, cargo_id) VALUES (?,?,?)");
        $stmt->execute([$nome, $email, $cargo_id]);

        return json_encode(["Success" => "Funcionario criado com sucesso"]);
    }


    public function listarFuncionarios() {
        global $pdo;

        $stmt = $pdo->prepare("SELECT f.id, f.nome, f.email, c.nome as cargo From funcionarios f JOIN cargos c ON f.cargo_id = c.id");
        $stmt->execute();

        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($funcionarios);
    }

    public function deletarFuncionario($id){
        global $pdo;

        $stmt = $pdo->prepare("Delete FROM funcionarios WHERE id = ?");
        $stmt->execute([$id]);

        return json_encode(['Success' => "Funcionario deletado com sucesso."]);
    }
}

?>