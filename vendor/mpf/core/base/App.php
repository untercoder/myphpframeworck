<?php


namespace mpf\core\base;
use mpf\core\base\Registry;
use mpf\core\base\ErrorHandler;


class App {

    public static $app;
    public function __construct(){
        session_start();
        self::$app = Registry::instance();
        new ErrorHandler();
    }
}