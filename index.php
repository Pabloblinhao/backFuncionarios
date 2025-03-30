<?php
// index.php

require_once __DIR__ . '/controllers/FuncionarioController.php';
require_once __DIR__ . '/controllers/CargoController.php';

// Definir cabeçalhos HTTP corretamente
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Tratar requisições OPTIONS para CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Definir as rotas
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $controller = null;

    if ($_GET['action'] == 'listarFuncionarios') {
        $controller = new FuncionarioController();
        $dados = $controller->listarFuncionarios();
    } elseif ($_GET['action'] == 'listarCargos') {
        $controller = new CargoController();
        $dados = $controller->listarCargos();
    }

    if ($controller) {
        echo json_encode($dados);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Rota não encontrada"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($_GET['action'] == 'criarFuncionario') {
        $controller = new FuncionarioController();
        $dados = $controller->criarFuncionario($data);
        echo json_encode($dados);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['action'])) {
    if ($_GET['action'] == 'deletarFuncionario' && isset($_GET['id'])) {
        $controller = new FuncionarioController();
        $dados = $controller->deletarFuncionario($_GET['id']);
        echo json_encode($dados);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "ID necessário para deletar funcionário"]);
    }
}
?>