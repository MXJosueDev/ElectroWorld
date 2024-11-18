<?php

require_once __DIR__ . "/../../../config.php";

?>

<main class="flex-grow-1">
    <?php

    include COMPONENTS_PATH . 'shared/hero.php';

    genHero('providers/heroContent.php');

    ?>

    <div class="container mt-4 mb-5">
        <div id="providersWrapper">
            <?php include PUBLIC_PATH . "provedores/providers.php"; ?>
        </div>
    </div>

</main>

<?php

include COMPONENTS_PATH . 'shared/CRUDModal.php';

genCRUDModal('shops/shopsForm.php');
