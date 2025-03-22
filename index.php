<?php
// index.php

require_once __DIR__ . '/controllers/FuncionarioController.php';
require_once __DIR__ . '/controllers/CargoController.php';

header('Content-Type: application/json');

// Adicionar cabeçalhos CORS para permitir acesso do frontend
header("Access-Control-Allow-Origin: http://localhost:5173"); // URL do frontend
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Cabeçalhos permitidos

// Tratar o método OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0); // Interrompe a execução do script para o CORS
}

// Definir as rotas
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['action'] == 'listarFuncionarios') {
        $controller = new FuncionarioController();
        echo $controller->listarFuncionarios();
    } elseif ($_GET['action'] == 'listarCargos') {
        $controller = new CargoController();
        echo $controller->listarCargos();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_GET['action'] == 'criarFuncionario') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cargo_id = $_POST['cargo_id'];

        $controller = new FuncionarioController();
        echo $controller->criarFuncionario($nome, $email, $cargo_id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if ($_GET['action'] == 'deletarFuncionario') {
        $id = $_GET['id'];

        $controller = new FuncionarioController();
        echo $controller->deletarFuncionario($id);
    }
}
?>