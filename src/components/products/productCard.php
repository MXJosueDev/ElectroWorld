<?php

function productCard(int $productId, string $name, float $price, string $description, int $quantity, int $providerId, string $image_url, array $providers)
{
?>
    <div class="col">
        <div class="card p-3 shadow h-100">
            <button type="button" class="productOptions" data-bs-toggle="modal" data-bs-target="#CRUDModal" data-bs-whatever="<?php echo $productId ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                </svg>
            </button>
            <h5 class="card-title mb-1"><?php echo $name; ?></h5>
            <h6 class="card-subtitle text-body-secondary mb-2">$<?php echo $price; ?></h6>
            <div class="ratio ratio-4x3 rounded border overflow-hidden">
                <img class="object-fit-cover" src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>">
            </div>
            <div class="card-body">
                <div class="product-description text-body-secondary">
                    <p class="card-text"><?php echo $description; ?></p>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Cantidad: <?php echo $quantity; ?>
                </li>
                <li class="list-group-item">
                    Proveedor:
                    <?php
                    foreach ($providers as $provider) {
                        if ($provider['id_proveedor'] == $providerId) {
                            echo $provider['nombre'];
                            break;
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>

    <!-- <div class="col">
        <div class="card m-2 shadow h-100">
            <button type="button" class="productOptions" data-bs-toggle="modal" data-bs-target="#CRUDModal" data-bs-whatever="<?php echo $productId ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                </svg>
            </button>
            <div class="ratio ratio-1x1">
                <img src="<?php echo $image_url; ?>" class="card-img-top aspect p-1" alt="<?php echo $name; ?>">
            </div>
            <div class="card-body w-100">
                <h5 class="card-title"><?php echo $name; ?></h5>
                <!-- <h6 class="card-subtitle mb-2 text-body-secondary">$<?php echo $price; ?></h6>
                <p class="card-text"><?php echo $description; ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Precio: $<?php echo $price; ?></li>
                <li class="list-group-item">Cantidad: <?php echo $quantity; ?></li>
                <li class="list-group-item">Proveedor:
                    <?php
                    foreach ($providers as $provider) {
                        if ($provider['id_proveedor'] == $providerId) {
                            echo $provider['nombre'];
                            break;
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div> -->
<?php }
