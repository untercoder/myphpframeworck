<?php


namespace mpf\core\base;
use mpf\core\base\ErrorHandler;


class Controller
{
    public $route = [];
    public $vars = [];
    public $view;
    public $layout;


    //подключает view в соответствие имени action
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->layout = '';
        $this->view = $route['action'];
    }


    public function getView()
    {
        $viewObj = new View($this->route, $this->view, $this->layout);
        $viewObj->render($this->vars);
    }


    public function setVars(array $vars): void
    {
        $this->vars = $vars;
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        $file_view = APP."/views/{$this->route['controller']}/{$view}.php";
        if(is_file($file_view)) {
            require $file_view;
        }else {
            throw new \Exception("View not found".$file_view);
        }
    }


}