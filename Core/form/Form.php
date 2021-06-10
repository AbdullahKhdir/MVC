<?php
namespace app\Core\form;

use app\core\Application;
use app\Core\Controller;
use app\models\RegisterModel;

class Form{

    public function __construct(){}

    public static function begin($action, $method, $submit){
        echo sprintf("<form action='%s' method='%s' onsubmit='%s'>", $action, $method, $submit);
        return new Form();
    }

    public static function end(){
        echo "</form>";
    }

    public static function field(RegisterModel $model, string $attribute): Field
    {
        return new Field($model, $attribute);
    }

    public static function btn(){
        return "<button class='btn btn-outline-primary' type='submit' name='register' style='margin-bottom: 20px'> Register </button>";

    }
}