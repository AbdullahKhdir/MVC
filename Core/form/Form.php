<?php
namespace app\Core\form;

use app\models\RegisterModel;

class Form{

    public function __construct(){}

    public static function begin($action, $method){
        echo sprintf("<form action='%s' method='%s'>", $action, $method);
        return new Form();
    }

    public static function end(){
        echo "</form>";
    }

    public static function field(RegisterModel $model, string $attribute): Field
    {
        return new Field($model, $attribute);
    }

}