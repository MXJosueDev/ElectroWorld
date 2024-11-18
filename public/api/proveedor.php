<?php

error_reporting(0);

require_once '../../vendor/autoload.php';

use Josue\Electroworld\DB;
use Josue\Electroworld\APIHandler;

$apiHandler = new APIHandler();

$apiHandler->GET(function (int $idProveedor) {
    $proveedor = DB::selectProveedor($idProveedor);

    return [200, $proveedor];
});

$apiHandler->POST(function (string $nombre, string $direccion, string $telefono) {
    DB::insertProveedor($nombre, $direccion, $telefono);

    return [201, []];
});

$apiHandler->DELETE(function (int $idProveedor) {
    DB::deleteProveedor($idProveedor);

    return [204, []];
});

$apiHandler->PUT(function (int $idProveedor, string $nombre, string $direccion, string $telefono) {
    DB::updateProveedor($nombre, $direccion, $telefono, $idProveedor);

    return [200, []];
});

$apiHandler->handleRequest();
