<?php

require_once __DIR__ . "/../../config.php";
include_once AUTOLOAD_PATH;

include_once COMPONENTS_PATH . 'products/productCard.php';

use Josue\Electroworld\DB;

$products = DB::selectAllProducto();
$providers = DB::selectAllProveedor();

foreach ($products as $product) {
    productCard($product['id_producto'], $product['nombre'], $product['precio'], $product['descripcion'], $product['cantidad'], $product['id_proveedor'], $product['image_data'], $providers);
}
