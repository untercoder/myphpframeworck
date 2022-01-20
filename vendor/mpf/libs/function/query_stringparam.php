<?php
//Нужен для отделения URL от его параметров
function queryStringParam($url) : string {
    if(isset($url)) {
        $params = explode('&', $url, 2);
        if(false === strpos($params[0], '=')) {
            return rtrim($params[0], '/');
        } else {
            return '';
        }
    }
}
