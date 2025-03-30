<?php
require_once __DIR__ . '/../config/db.php';

class CargoService {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function listarCargos() {
        $stmt = $this->conn->prepare("SELECT * FROM cargos");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>