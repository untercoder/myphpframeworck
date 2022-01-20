<?php


namespace mpf\core\base;

use mpf\core\DataBase;
use Valitron\Validator;


abstract class Model {
    protected $pdo;
    protected $table;
    protected $pk = 'id';
    public $attributes = [];
    public $errors_v = [];
    public $rules = [];

     public function __construct() {
         $this->pdo = DataBase::instance();
     }

     public function load($data) {
         foreach ($this->attributes as $name => $value) {
             if(isset($data[$name])) {
                 $this->attributes[$name] = $data[$name];
             }
         }
     }

     public function save($table) {
         $tbl = \R::dispense($table);
         foreach ($this->attributes as $attribute => $value) {
             $tbl->$attribute = $value;
         }
         return \R::store($tbl);
     }

     public function validate($data) {
         Validator::lang('ru');
         $v = new Validator($data);
         $v->rules($this->rules);
         if($v->validate()) {
             return true;
         }
         $this->errors_v = $v->errors();
         return false;
     }


    public function getErrorsV(): array
    {
        return $this->errors_v;
    }


 }