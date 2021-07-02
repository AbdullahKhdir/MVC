<?php
namespace app\Core\form;

use app\core\Application;
use app\Core\Controller;
use app\models\RegisterModel;

class Form{

    public function __construct(){}

    public static function begin($action, $method, $submit, $encType = ""){
        echo sprintf("<form action='%s' method='%s' onsubmit='%s' enctype='%s'>", $action, $method, $submit, $encType);
        return new Form();
    }

    public static function end(){
        echo "</form>";
    }

    public static function field(RegisterModel $model, string $attribute): Field{
        return new Field($model, $attribute);
    }

    public static function btn(){
        if(!isset($_SESSION["userName"])){
            if ($_SERVER["PATH_INFO"] === "/login"){
                return '<button class="btn btn-outline-primary" type="submit" name="SignIn" style="margin-bottom: 20px"> Login </button> ';
            }elseif($_SERVER["PATH_INFO"] === "/reg"){
                return "<button class='btn btn-outline-primary' type='submit' name='register' style='margin-bottom: 20px'> Register </button>";
            }
        }
    }

    public static function btnComponent($name){
        return "<div class='d-flex justify-content-sm-end'>
                     <button class='btn btn-sm btn-primary' name='$name'>Submit</button>
                </div></div></div>";
    }
}