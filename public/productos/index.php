<?php

require_once __DIR__ . '/../../config.php';

include COMPONENTS_PATH . 'shared/base.php';

genIndex('products/main.php', ['/electroworld/assets/products/products.js'], ['/electroworld/assets/products/products.css']);

