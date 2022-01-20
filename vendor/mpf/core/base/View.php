<?php


namespace mpf\core\base;


class View {
    public $rout = []; //текущий маршрут
    public $view;//текущий вид
    public $layout;
    public $scripts = [];
    public static $meta = [];


    public function __construct( $rout, $view = '', $layout = '')
    {
        $this->rout = $rout;
        $this->view = $view;
        if($layout === false) {
            $this -> layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($vars) {
        if($this->view !== false) {
            extract($vars);
            $file_view = APP."/views/{$this->rout['prefix']}{$this->rout['controller']}/{$this->view}.php";
            ob_start();
            if(is_file($file_view)) {
                require $file_view;
            }else {
                throw new \Exception("View not found".$file_view, 404);
            }

            $content = ob_get_clean();
        }

        if($this->layout !== false) {
            $file_layout = APP."/views/layouts/{$this->rout['prefix']}{$this->layout}.php";
            if(is_file($file_layout)) {
                $content = $this->getScript($content);
                $scripts = [];
                if(!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require $file_layout;

            } else {
                throw new \Exception('Layout not found'.$file_layout, 404);
            }
        }
    }

    public function getScript($content) {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts );
        if(!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }


    public static function getMeta(): void
    {
        echo '<title>'.self::$meta['title'].'</title>
        <meta name="description" content="'.self::$meta['desc'].'">
        <meta name="keywords" content="'.self::$meta['keywords'].'">';
    }

    public static function setMeta($title = 'default', $desc = 'default', $keywords = 'default'): void
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }




}