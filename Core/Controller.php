<?php


namespace app\Core;


class Controller
{

   public function __construct(){}

   public function render($view, $params = []){
       return Application::$app->router->renderView($view, $params);
   }

}