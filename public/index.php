<?php
require_once __DIR__ ."/../vendor/autoload.php";
require_once __DIR__."/../Core/Request.php";
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\Core\application;
use app\core\Request;
use app\Core\Response;

$app = new \app\Core\Application(dirname(__DIR__));

    $app->router->get("/", function(){
        return (new SiteController())->handleHome();
    });
    $app->router->post("/", function(Request $req){
        return (new SiteController())->handlePostedData($req);
    });

    $app->router->get("/users", function(){
        echo "Users Route";
    });
    $app->router->get("/about", function(){
        echo "About Route";
    });
    $app->router->get("/contact", function(){
       return (new SiteController())->contact();
    });

    $app->router->get("/login", function(){
        return (new AuthController())->login();
    });
    $app->router->post("/login", function(Request $req){
        return (new AuthController())->handleLogin($req);
    });

    $app->router->get("/reg", function(){
        return (new AuthController())->register();
    });
    $app->router->post("/reg", function(Request $req){
        return (new AuthController())->handleRegister($req);
    });

    $app->run();

