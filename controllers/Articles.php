<?php


namespace app\controllers;


use app\core\Application;
use app\Core\Controller;
use app\core\Request;

class Articles extends Controller {

    public function __construct(){}

    public function renderArticles(){
        if (isset($_SESSION["protectedRoutes"])){
            if ($_SESSION["protectedRoutes"] === "abdullah.khdir@telekom.de"){
                $this->render("articles");
            }else{
                echo "<p style='text-align: center'>Not Found!</p>";
            }
        }else{
            echo "<p style='text-align: center'>Not Found!</p>";
        }
    }

    public function handleArticles(Request $req){

    }

}