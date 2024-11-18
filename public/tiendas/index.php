<?php

require __DIR__ . '/../../config.php';

include COMPONENTS_PATH . 'shared/base.php';

genIndex('shops/main.php', ['/electroworld/assets/shops/shops.js'], ['/electroworld/assets/shops/shops.css']);
