<?php

require_once __DIR__ . '/../../../config.php';

function genHero(?string $content)
{ ?>
    <div id="hero" class="w-100">
        <div class="h-100 w-100 d-flex justify-content-center align-items-center flex-colum">
            <div class="container">
                <?php if ($content) {
                    include COMPONENTS_PATH . $content;
                } ?>
            </div>
        </div>
    </div>
<?php }
