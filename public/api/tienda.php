<?php

error_reporting(0);

require_once '../../vendor/autoload.php';

use Josue\Electroworld\DB;
use Josue\Electroworld\APIHandler;

$apiHandler = new APIHandler();

$apiHandler->GET(function (int $idTienda) {
    $tienda = DB::selectTienda($idTienda);

    return [200, $tienda];
});

$apiHandler->POST(function (string $nombre, string $direccion, string $telefono) {
    DB::insertTienda($direccion, $telefono, $nombre);

    return [201, []];
});

$apiHandler->DELETE(function (int $idTienda) {
    DB::deleteTienda($idTienda);

    return [204, []];
});

$apiHandler->PUT(function (int $idTienda, string $nombre, string $direccion, string $telefono) {
    DB::updateTienda($direccion, $telefono, $nombre, $idTienda);

    return [200, []];
});

$apiHandler->handleRequest();
