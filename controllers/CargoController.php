<?php

require_once __DIR__ . '/../services/CargoService.php';


class CargoController {

    public function listarCargos(){
        $cargoService = New CargoService();
        return $cargoService->listarCargos();
    }
}
?>