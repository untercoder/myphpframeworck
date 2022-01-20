<?php


namespace mpf\core;


class DataBase {


    public static $instance;


    protected function __construct() {
        $dbLogin = require ROOT . '/config/config_db.php';
        require LIBS."/rb.php";
        \R::setup($dbLogin['dsn'], $dbLogin['user'], $dbLogin['pass']);
//        \R::freeze(true);
//        \R::fancyDebug(true);
    }

    public static function instance(): DataBase
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


}