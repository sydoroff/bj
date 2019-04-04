<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 31.03.2019
 * Time: 13:14
 */

class DB
{
    const TYPE_DB = 'mysql';
    const HOST_DB = 'localhost';
    const NAME_DB = 'task';
    const USER_DB = 'root';
    const PASS_DB = '';

    static function connect_db(){
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
       return new PDO(self::TYPE_DB.
           ':host='.self::HOST_DB.
           ';dbname='.self::NAME_DB.';',
           self::USER_DB,
           self::PASS_DB,
           $opt);
}
}