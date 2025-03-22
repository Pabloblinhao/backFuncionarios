<?php
// services/CargoService.php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Cargo.php';

class CargoService {

    public function listarCargos() {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM cargos");
        $stmt->execute();

        $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($cargos);
    }
}
?>