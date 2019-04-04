<?php

if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
    ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
        PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
    ob_start(null, 0, false);
}

require_once ('./controller/IndexController.php');

$cont = new IndexController;

$cont->confirm()->run();

ob_flush();