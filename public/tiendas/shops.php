<?php

require_once __DIR__ . '/../../config.php';

?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Productos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once AUTOLOAD_PATH;

            use Josue\Electroworld\DB;

            $shops = DB::selectAllTienda();
            $products = DB::selectAllProducto();
            $shopsProducts = DB::selectAllTiendaProducto();

            $shopProducts = array_reduce($shopsProducts, function ($acc, $shopProduct) {
                $acc[$shopProduct['id_tienda']][] = $shopProduct['id_producto'];
                return $acc;
            }, []);

            foreach ($shops as $shop) {
                if (!isset($shopProducts[$shop['id_tienda']])) {
                    $shopProducts[$shop['id_tienda']] = [];
                }

                echo "<tr>";
                echo "<td>{$shop['id_tienda']}</td>";
                echo "<td>{$shop['nombre']}</td>";
                echo "<td>{$shop['direccion']}</td>";
                echo "<td>{$shop['telefono']}</td>"; ?>

                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                            Seleccionar Productos
                        </button>

                        <div class="dropdown-menu">
                            <div class="px-2">
                                <?php foreach ($products as $product) { ?>
                                    <div class='form-check'>
                                        <input class='form-check-input shopProductCheckbox' type='checkbox' value='<?php echo $product['id_producto'] ?>' id="<?php echo $shop['id_tienda'] . '_' . $product['id_producto'] ?>" <?php if (in_array($product['id_producto'], $shopProducts[$shop['id_tienda']])) echo "checked" ?>>
                                        <label class='form-check-label' for='<?php echo $shop['id_tienda'] . '_' . $product['id_producto'] ?>'>
                                            <?php echo $product['nombre']; ?>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="shopOptions" data-bs-toggle="modal" data-bs-target="#CRUDModal" data-bs-whatever="<?php echo $shop['id_tienda'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                            </svg>
                        </button>
                    </div>
                </td>

            <?php
                echo "</tr>";
            }
            ?>
    </table>
</div>