<?php

require_once __DIR__ . '/../../../config.php';

?>

<main class="flex-grow-1">
    <?php

    include COMPONENTS_PATH . 'shared/hero.php';

    genHero('products/heroContent.php');
    
    ?>

    <div class="container">
        <div id="productsWrapper" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mt-3 mb-5">
            <?php include PUBLIC_PATH . "productos/products.php"; ?>
        </div>
    </div>

</main>

<?php

include COMPONENTS_PATH . 'shared/CRUDModal.php';

genCRUDModal('products/productForm.php');
