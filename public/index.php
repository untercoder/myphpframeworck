<?php

use mpf\core\Router;
use mpf\core\base\App;


require_once '../vendor/mpf/libs/function/debag_array.php';
require_once '../vendor/mpf/libs/function/camel_case.php';
require_once '../vendor/mpf/libs/function/query_stringparam.php';

define("DEBUG", 1);
define("CONTROLLERS", dirname(__DIR__)."/app/controllers");
define("ROOT", dirname(__DIR__));
define("APP", dirname(__DIR__)."/app");
define("LAYOUT", "default");
define("LIBS", dirname(__DIR__) . "/vendor/mpf/libs");
define("CACHE", dirname(__DIR__)."/tmp/cache");
define("ERRORS_DIR", dirname(__DIR__)."/tmp/errors_log");
define("VENDOR", dirname(__DIR__)."/vendor");

require VENDOR."/autoload.php";

$query = $_SERVER["QUERY_STRING"];

new App();


// ^$ - в регулярных выражениях это обозначает пустую строку. ^ - начало строки
// $ - конец строки
Router::add('^$', ['controller' => 'Main', 'action' => 'main', 'prefix' => 'user']);


//шаблон с использованием регвлярных выражений для подобных url controller/action/param
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' , ['prefix' => 'admin']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'user']);


Router::dispatch($query);

if(DEBUG) {
    Router::info();
}
