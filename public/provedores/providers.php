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
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once AUTOLOAD_PATH;

            use Josue\Electroworld\DB;

            $providers = DB::selectAllProveedor();

            foreach ($providers as $provider) {
                echo "<tr>";
                echo "<td>{$provider['id_proveedor']}</td>";
                echo "<td>{$provider['nombre']}</td>";
                echo "<td>{$provider['direccion']}</td>";
                echo "<td>{$provider['telefono']}</td>"; ?>

                <td>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="providerOptions" data-bs-toggle="modal" data-bs-target="#CRUDModal" data-bs-whatever="<?php echo $provider['id_proveedor'] ?>">
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