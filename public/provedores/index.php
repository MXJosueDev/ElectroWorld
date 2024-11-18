<?php

require __DIR__ . '/../../config.php';

include COMPONENTS_PATH . 'shared/base.php';

genIndex('providers/main.php', ['/electroworld/assets/providers/providers.js'], ['/electroworld/assets/providers/providers.css']);
