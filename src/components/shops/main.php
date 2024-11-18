<?php

require_once __DIR__ . "/../../../config.php";

?>

<main class="flex-grow-1">
    <?php

    include COMPONENTS_PATH . 'shared/hero.php';

    genHero('shops/heroContent.php');

    ?>

    <div class="container mt-4 mb-5 h-100">
        <div id="shopsWrapper" class="h-100">
            <?php include PUBLIC_PATH . "tiendas/shops.php"; ?>
        </div>
    </div>

</main>

<?php

include COMPONENTS_PATH . 'shared/CRUDModal.php';

genCRUDModal('shops/shopsForm.php');
