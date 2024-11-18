<?php

// error_reporting(0);

require_once '../../vendor/autoload.php';

use Josue\Electroworld\DB;
use Josue\Electroworld\APIHandler;

$apiHandler = new APIHandler();

$apiHandler->GET(function (int $idProducto) {
    $producto = DB::selectProducto($idProducto);

    return [200, $producto];
});

$apiHandler->POST(function (string $nombre, string $descripcion, float $precio, int $cantidad, string $imageData, int $idProveedor) {

    DB::insertProducto($nombre, $descripcion, $precio, $cantidad, $imageData, $idProveedor);

    return [201, []];
});

$apiHandler->DELETE(function (int $idProducto) {
    DB::deleteProducto($idProducto);

    return [204, []];
});

$apiHandler->PUT(function (int $idProducto, string $nombre, string $descripcion, float $precio, int $cantidad, string $imageData, int $idProveedor) {
    DB::updateProducto($nombre, $descripcion, $precio, $cantidad, $imageData, $idProveedor, $idProducto);

    return [200, []];
});

$apiHandler->handleRequest();
