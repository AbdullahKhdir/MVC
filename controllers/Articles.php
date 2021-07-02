<?php


namespace app\controllers;


use app\core\Application;
use app\Core\Controller;
use app\Core\Database;
use app\core\Request;
use Dotenv\Dotenv;
use PDO;

class Articles extends Controller {

    public function __construct(){}

    public function renderArticles(){
        if (isset($_SESSION["protectedRoutes"])){
            $authUsers = (new AuthorizedUsers())->getAuthUsers();

            foreach ($authUsers as $user => $item){
                if (in_array($_SESSION["protectedRoutes"], $item)){
                    $this->render("articles");
                }
            }

        }else{
            echo "<p style='text-align: center'>Not Found!</p>";
        }
    }

    public function handleArticles(Request $req){

    }

}