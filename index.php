<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 31.03.2019
 * Time: 13:40
 */

require_once ('./controller/IndexController.php');

$cont = new IndexController;

$cont->index()->run();

