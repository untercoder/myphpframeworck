<?php


namespace mpf\core\base;


class Registry {

    public static $instance;
     public static $objects = [];

    protected function __construct() {
        $config = require ROOT . '/config/config.php';
        foreach ($config['components'] as $name => $obj) {
            self::$objects[$name] = new $obj;
        }
    }

    public static function instance(): Registry {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __get($name) {
        if(is_object(self::$objects[$name])) {
            return self::$objects[$name];
        } else {
            return null;
        }
    }

    public function __set($name, $obj) {
        if(!isset(self::$objects[$name])) {
            self::$objects[$name] = new $obj;
        }
    }

    public function getListObjects(): void {
        var_dump(self::$objects);
    }




}