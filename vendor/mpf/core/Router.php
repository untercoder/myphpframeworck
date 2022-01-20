<?php

namespace mpf\core;

class Router {

    protected static $route = [];
    protected static $routes = [];

    //добавляет мршруты по ключам и значениям в массив $routes
    // принимает аргументы в таком формате Route::add('route/name', [controller => nameController, action => actionName]
    public static function add($regexp, $route = []): void {
        self::$routes[$regexp] = $route;
    }

    //Возвращает список маршрутов(массив routes) : string array
    public  static  function getRoutes(): array{
        return self::$routes;
    }

    //Возврашает активный маршрут : string array
    public static function getRoute(): array {
        return self::$route;
    }

    //Функция которая сопостовляет существующие маршруты с url
    //Использую preg_match для проверки регулярного выражения

    public static function matchRoute($url): bool {
        foreach (self::$routes as $pattern => $route) {
            if(preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $var) {
                    if(is_string($key)) {
                        $route[$key] = $var;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }

                if(!isset($route['prefix'])) {
                   $route['prefix'] = '';
                } else {
                    $route['prefix'] .= "\\";
                }

                $route['controller'] = camelCase($route['controller'])."Controller";
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //Метод который подключает существующий контроллер
    public static function dispatch($url) : void {
        $url = queryStringParam($url);
        if(self::matchRoute($url)) {
            $controller = "app\controllers\\".self::$route['prefix'].self::$route['controller'];
            if(class_exists($controller)) {
                $controllerObj = new $controller(self::$route);
                $action = lowerCamelCase(self::$route['action'])."Action";
                if(method_exists($controllerObj, $action)) {
                    $controllerObj -> $action();
                    $controllerObj -> getView();
                } else {
                    throw new \Exception("Method ".$controller."::".$action." not found", 500);
                }
            } else {
                throw new \Exception("Controller ".$controller." not found", 500);
            }
        } else {
            throw new \Exception("Page not found", 404);
        }
    }

    public static function info() {
        echo debagArray(self::$route);
    }
}