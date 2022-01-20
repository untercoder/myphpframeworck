<?php

namespace app\controllers\user;
use app\models\Main;
use app\models\User;
use mpf\core\base\App;
use mpf\core\base\Model;
use mpf\core\base\View;

class MainController extends AppController
{
    public function mainAction() {
        View::setMeta("Я работаю");
        $this->layout = 'bootstrap';
        $this->view = 'main';
    }

}