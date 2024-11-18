<?php

error_reporting(0);

require_once '../../vendor/autoload.php';

use Josue\Electroworld\DB;
use Josue\Electroworld\APIHandler;

$apiHandler = new APIHandler();

$apiHandler->GET(function () {
    $proveedor = DB::selectAllProveedor();

    return [200, $proveedor];
});

$apiHandler->handleRequest();
