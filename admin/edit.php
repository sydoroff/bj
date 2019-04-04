<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 01.04.2019
 * Time: 1:29
 */
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
    ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
        PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
    ob_start(null, 0, false);
}

require_once ($_SERVER['DOCUMENT_ROOT'].'/controller/AdminController.php');

$cont = new AdminController;

$cont->edit()->run();

ob_flush();