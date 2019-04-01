<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 01.04.2019
 * Time: 1:19
 */
 require_once ($_SERVER['DOCUMENT_ROOT'].'/controller/AdminController.php');

 $cont = new AdminController;

 $cont->index()->run();