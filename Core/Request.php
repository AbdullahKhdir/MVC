<?php
namespace app\core;

class Request{
    public function __construct(){}

    public function getPath(){
        $path = $_SERVER["REQUEST_URI"] ?? "/";
        $position = strpos($path, "?");

        if (!$position){
           return $path;
        }else{
           return substr($path, 0, $position);
        }

    }

    public function getMethod(){
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getBody(){
        $body = [];

        if ($this->getMethod() === "get"){
            foreach ($_GET as $param => $value){
                $body[$param] = filter_input(INPUT_GET, $param,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }elseif ($this->getMethod() === "post"){
            foreach ($_POST as $param => $value){
                $body[$param] = filter_input(INPUT_POST, $param,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        //var_dump($_POST);
        return $body;
    }

}