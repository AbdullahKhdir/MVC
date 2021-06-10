<?php
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\Core\application;
use app\core\Request;
use app\Core\Response;

require_once __DIR__ ."/../vendor/autoload.php";
require_once __DIR__."/../Core/Request.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$config = [
    "DB" => [
        "dsn" => $_ENV['DB_DSN'],
        "user" => $_ENV['DB_USER'],
        "password" => $_ENV['DB_PASSWORD'],
    ],
];

$app = new \app\Core\Application(dirname(__DIR__), $config);

    $app->router->get("/home", "home");

    $app->router->get("/", function(){
        return (new SiteController())->handleHome();
    });
    $app->router->post("/", function(Request $req){
        return (new SiteController())->handleHomePostedData($req);
    });

    //-----------------------------------------------

    $app->router->get("/users", function(){
        echo "Users Route";
    });

    //-----------------------------------------------

    $app->router->get("/about", function(){
        echo "About Route";
    });

    //-----------------------------------------------

    $app->router->get("/contact", function(){
       return (new SiteController())->contact();
    });

    //-----------------------------------------------

    $app->router->get("/login", function(){
         return (new AuthController())->renderLogin();
    });

    $app->router->post("/login", function(Request $req){
        return (new AuthController())->handleLogin($req);
    });

    //-----------------------------------------------

    $app->router->get("/reg", function(Request $req){
        return (new AuthController())->renderRegister();
    });
    $app->router->post("/reg", function(Request $req){
        return (new AuthController())->handleRegister($req);
    });

    //-----------------------------------------------


    $app->run();