<?php

error_reporting(0);

require_once '../../vendor/autoload.php';

use Josue\Electroworld\DB;
use Josue\Electroworld\APIHandler;

$apiHandler = new APIHandler();

$apiHandler->GET(function (int $idTienda, int $idProducto) {
    $tienda_producto = DB::selectTiendaProducto($idTienda, $idProducto);

    return [200, $tienda_producto];
});

$apiHandler->POST(function (int $idTienda, int $idProducto) {
    DB::insertTiendaProducto($idTienda, $idProducto);

    return [201, ["ok" => true]];
});

$apiHandler->DELETE(function (int $idTienda, int $idProducto) {
    DB::deleteTiendaProducto($idTienda, $idProducto);

    return [204, []];
});

$apiHandler->handleRequest();
