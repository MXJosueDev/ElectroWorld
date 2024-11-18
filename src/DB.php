<?php

namespace Josue\Electroworld;

use Exception;

class DB
{
    private static DB $db;

    public static function getGlobalConn(): \mysqli|false
    {
        if (!isset(self::$db)) {
            self::$db = new DB();
        }

        $conn = self::$db->getConnection();

        if (!$conn) return false;

        return $conn;
    }

    public static function prepareStmt(string $queryKey, mixed ...$queryParams): ?\mysqli_stmt
    {
        if (!isset(self::QUERIES[$queryKey])) return null;

        $stmt = self::getGlobalConn()->prepare(self::QUERIES[$queryKey]);

        if (!$stmt) return null;
        if (self::QUERIES_PARAMS[$queryKey] !== null) $stmt->bind_param(self::QUERIES_PARAMS[$queryKey], ...$queryParams);

        return $stmt;
    }

    /**
     * @return array<\mysqli_stmt|\mysqli_result>
     */
    public static function query(string $queryKey, mixed ...$queryParams): array|false
    {
        $stmt = self::prepareStmt($queryKey, ...$queryParams);

        try {
            if (!$stmt->execute()) return false;
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return false;
        }

        $result = $stmt->get_result();

        return [$stmt, $result];
    }

    public static function endQuery(?\mysqli_stmt $stmt, \mysqli_result|bool $result): void
    {
        if ($stmt instanceof \mysqli_stmt) $stmt->close();
        if ($result instanceof \mysqli_result) $result->close();
    }

    // Static Queries for producto
    public static function insertProducto(string $nombre, string $descripcion, float $precio, int $cantidad, string $imageData, int $idProveedor)
    {
        [$stmt, $result] = self::query("insert_producto", $nombre, $descripcion, $precio, $cantidad, $imageData, $idProveedor);
        self::endQuery($stmt, $result);
    }

    public static function selectProducto(int $idProducto)
    {
        [$stmt, $result] = self::query("select_producto", $idProducto);
        $data = $result->fetch_assoc();
        self::endQuery($stmt, $result);
        return $data;
    }

    public static function updateProducto(string $nombre, string $descripcion, float $precio, int $cantidad, string $imageData, int $idProveedor, int $idProducto)
    {
        [$stmt, $result] = self::query("update_producto", $nombre, $descripcion, $precio, $cantidad, $imageData, $idProveedor, $idProducto);
        self::endQuery($stmt, $result);
    }

    public static function deleteProducto(int $idProducto)
    {
        [$stmt, $result] = self::query("delete_producto", $idProducto);
        self::endQuery($stmt, $result);
    }

    public static function selectAllProducto()
    {
        [$stmt, $result] = self::query("select_all_producto");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        self::endQuery($stmt, $result);
        return $data;
    }

    // Static Queries for tienda
    public static function insertTienda(string $direccion, string $telefono, string $nombre)
    {
        [$stmt, $result] = self::query("insert_tienda", $direccion, $telefono, $nombre);
        self::endQuery($stmt, $result);
    }

    public static function selectTienda(int $idTienda)
    {
        [$stmt, $result] = self::query("select_tienda", $idTienda);
        $data = $result->fetch_assoc();
        self::endQuery($stmt, $result);
        return $data;
    }

    public static function updateTienda(string $direccion, string $telefono, string $nombre, int $idTienda)
    {
        [$stmt, $result] = self::query("update_tienda", $direccion, $telefono, $nombre, $idTienda);
        self::endQuery($stmt, $result);
    }

    public static function deleteTienda(int $idTienda)
    {
        [$stmt, $result] = self::query("delete_tienda", $idTienda);
        self::endQuery($stmt, $result);
    }

    public static function selectAllTienda()
    {
        [$stmt, $result] = self::query("select_all_tienda");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        self::endQuery($stmt, $result);
        return $data;
    }

    // Static Queries for proveedor
    public static function insertProveedor(string $nombre, string $direccion, string $telefono)
    {
        [$stmt, $result] = self::query("insert_proveedor", $nombre, $direccion, $telefono);
        self::endQuery($stmt, $result);
    }

    public static function selectProveedor(int $idProveedor)
    {
        [$stmt, $result] = self::query("select_proveedor", $idProveedor);
        $data = $result->fetch_assoc();
        self::endQuery($stmt, $result);
        return $data;
    }

    public static function updateProveedor(string $nombre, string $direccion, string $telefono, int $idProveedor)
    {
        [$stmt, $result] = self::query("update_proveedor", $nombre, $direccion, $telefono, $idProveedor);
        self::endQuery($stmt, $result);
    }

    public static function deleteProveedor(int $idProveedor)
    {
        [$stmt, $result] = self::query("delete_proveedor", $idProveedor);
        self::endQuery($stmt, $result);
    }

    public static function selectAllProveedor()
    {
        [$stmt, $result] = self::query("select_all_proveedor");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        self::endQuery($stmt, $result);
        return $data;
    }

    // Static Queries for tienda_producto
    public static function insertTiendaProducto(int $idTienda, int $idProducto)
    {
        [$stmt, $result] = self::query("insert_tienda_producto", $idTienda, $idProducto);
        self::endQuery($stmt, $result);
    }

    public static function selectTiendaProducto(int $idTienda, int $idProducto)
    {
        [$stmt, $result] = self::query("select_tienda_producto", $idTienda, $idProducto);
        $data = $result->fetch_assoc();
        self::endQuery($stmt, $result);
        return $data;
    }

    public static function deleteTiendaProducto(int $idTienda, int $idProducto)
    {
        [$stmt, $result] = self::query("delete_tienda_producto", $idTienda, $idProducto);
        self::endQuery($stmt, $result);
    }

    public static function selectAllTiendaProducto()
    {
        [$stmt, $result] = self::query("select_all_tienda_producto");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        self::endQuery($stmt, $result);
        return $data;
    }

    const QUERIES = [
        // CRUD for producto
        "insert_producto" => "INSERT INTO `producto` (`nombre`, `descripcion`, `precio`, `cantidad`, `image_data`, `id_proveedor`) VALUES (?, ?, ?, ?, ?, ?);",
        "select_producto" => "SELECT * FROM `producto` WHERE `id_producto` = ?;",
        "update_producto" => "UPDATE `producto` SET `nombre` = ?, `descripcion` = ?, `precio` = ?, `cantidad` = ?, `image_data` = ?, `id_proveedor` = ? WHERE `id_producto` = ?;",
        "delete_producto" => "DELETE FROM `producto` WHERE `id_producto` = ?;",
        "select_all_producto" => "SELECT * FROM `producto`;",

        // CRUD for tienda
        "insert_tienda" => "INSERT INTO `tienda` (`direccion`, `telefono`, `nombre`) VALUES (?, ?, ?);",
        "select_tienda" => "SELECT * FROM `tienda` WHERE `id_tienda` = ?;",
        "update_tienda" => "UPDATE `tienda` SET `direccion` = ?, `telefono` = ?, `nombre` = ? WHERE `id_tienda` = ?;",
        "delete_tienda" => "DELETE FROM `tienda` WHERE `id_tienda` = ?;",
        "select_all_tienda" => "SELECT * FROM `tienda`;",

        // CRUD for proveedor
        "insert_proveedor" => "INSERT INTO `proveedor` (`nombre`, `direccion`, `telefono`) VALUES (?, ?, ?);",
        "select_proveedor" => "SELECT * FROM `proveedor` WHERE `id_proveedor` = ?;",
        "update_proveedor" => "UPDATE `proveedor` SET `nombre` = ?, `direccion` = ?, `telefono` = ? WHERE `id_proveedor` = ?;",
        "delete_proveedor" => "DELETE FROM `proveedor` WHERE `id_proveedor` = ?;",
        "select_all_proveedor" => "SELECT * FROM `proveedor`;",

        // CRUD for tienda_producto
        "insert_tienda_producto" => "INSERT INTO `tienda_producto` (`id_tienda`, `id_producto`) VALUES (?, ?);",
        "select_tienda_producto" => "SELECT * FROM `tienda_producto` WHERE `id_tienda` = ? AND `id_producto` = ?;",
        "delete_tienda_producto" => "DELETE FROM `tienda_producto` WHERE `id_tienda` = ? AND `id_producto` = ?;",
        "select_all_tienda_producto" => "SELECT * FROM `tienda_producto`;"
    ];

    const QUERIES_PARAMS = [
        // CRUD for producto
        "insert_producto" => "ssdisi",
        "select_producto" => "i",
        "update_producto" => "ssdisii",
        "delete_producto" => "i",
        "select_all_producto" => null,

        // CRUD for tienda
        "insert_tienda" => "sss",
        "select_tienda" => "i",
        "update_tienda" => "sssi",
        "delete_tienda" => "i",
        "select_all_tienda" => null,

        // CRUD for proveedor
        "insert_proveedor" => "sss",
        "select_proveedor" => "i",
        "update_proveedor" => "sssi",
        "delete_proveedor" => "i",
        "select_all_proveedor" => null,

        // CRUD for tienda_producto
        "insert_tienda_producto" => "ii",
        "select_tienda_producto" => "ii",
        "delete_tienda_producto" => "ii",
        "select_all_tienda_producto" => null
    ];


    private \mysqli|false $conn;

    public function __construct()
    {
        $this->reconnect();
    }

    public function getConnection(): \mysqli|false
    {
        if ($this->conn instanceof \mysqli) {
            if ($this->conn->connect_error || !$this->conn->ping()) {
                return $this->reconnect();
            }
        }

        return $this->conn;
    }

    private function reconnect(): \mysqli|false
    {
        $hostname =  "localhost";
        $port = "3306";
        $username = "root";
        $password = "";
        $database = "componentes_electronicos";

        try {
            $this->conn = new \mysqli($hostname, $username, $password, $database, $port);
        } catch (Exception $exception) {
            $this->conn = false;
        }

        return $this->conn;
    }
}
