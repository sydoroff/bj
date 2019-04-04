<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 31.03.2019
 * Time: 21:44
 */
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
    ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
        PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
    ob_start(null, 0, false);
}

require_once ('./controller/Controller.php');

$cont = new Controller;

$cont->newTask()->run();

ob_flush();