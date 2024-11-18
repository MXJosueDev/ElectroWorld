<?php

require_once __DIR__ . '/../../../config.php';

function genIndex(string $main, array $js = [], array $css = []): void
{
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ElectroWorld</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/assets/css/theme.css">

        <?php
        if (count($css) > 0) {
            foreach ($css as $style) {
                echo "<link rel='stylesheet' href='$style'>";
            }
        }
        ?>
    </head>

    <body>
        <?php
        include COMPONENTS_PATH . 'shared/floatingButtons.php';
        ?>

        <div id="root" class="d-flex flex-column min-vh-100">
            <?php
            include COMPONENTS_PATH . 'shared/header.php';
            ?>

            <?php
            include COMPONENTS_PATH . $main;
            ?>
        </div>

        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/jquery.min.js"></script>

        <script src="/assets/js/CRUDModal.js"></script>

        <?php
        if (count($js) > 0) {
            foreach ($js as $script) {
                echo "<script src='$script'></script>";
            }
        }
        ?>
    </body>

    </html>
<?php }
