<?php


namespace mpf\core\base;


class ErrorHandler {

    public function __construct() {
        if(DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(1);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exeptionHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline) {
        error_log("[".date('Y-m-d H-i-s')."] \n Номер ошибки:".$errno." \n Текст ошибки: ".$errstr."\n Файл :
        ".$errfile."\n Строка ошибки: " .$errline."\n==============================\n", 3 ,
            ERRORS_DIR.'/errors.txt');
        $this->displayError($errno, $errstr, $errfile, $errline);
        return true;
    }

    public function exeptionHandler( $e) {
        error_log("[".date('Y-m-d H-i-s')."] \n Номер ошибки:".$e->getCode()." \n Текст ошибки: ".$e -> getMessage() ."\n Файл :
        ".$e -> getFile()."\n Строка ошибки: " .$e->getLine()."\n==============================\n", 3 ,
            ERRORS_DIR.'/errors.txt');
        $this->displayError("Exeption", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function fatalErrorHandler() {
         $error = error_get_last();
         if(!empty($error) && $error['type'] & (E_ERROR|E_COMPILE_ERROR|E_PARSE|E_CORE_ERROR)) {
             error_log("[".date('Y-m-d H-i-s')."] \n Номер ошибки:".$error['type']." \n Текст ошибки: ".$error['message']."\n Файл :
        ".$error['file']."\n Строка ошибки: " .$error['line']."\n==============================\n", 3 ,
                 ERRORS_DIR.'/errors.txt');
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
         }else {
             ob_end_flush();
         }
    }

    public function displayError($errno, $errstr, $errfile, $errline, $response = 500) {
        http_response_code($response);

        if($response === 404 && !DEBUG) {      
            require APP . '/views/ErrorHandler/404.html';
            die;
        }

        if(DEBUG) {
            require APP . '/views/ErrorHandler/dev.php';
        }else {
            require APP . '/views/ErrorHandler/prod.php';
        }
        die;
    }
}