<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 31.03.2019
 * Time: 13:40
 */

require_once ('./controller/Controller.php');

$cont = new Controller;

$cont->index()->run();

