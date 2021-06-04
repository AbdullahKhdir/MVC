<?php
namespace app\core;
require_once __DIR__."/../Core/Router.php";
require_once __DIR__."/../Core/Response.php";
require_once __DIR__."/../Core/Request.php";

use app\core\Router;
class Application{
    public static $ROOT_DIR;
    public namespace\Router $router;
    public namespace\Response $response;
    public namespace\Request $request;
    public static namespace\Application $app;

    public function __construct($rootPath){
        Application::$ROOT_DIR = $rootPath;
        Application::$app = $this;
        $this->response = new namespace\Response();
        $this->request = new namespace\Request();
        $this->router = new namespace\Router($this->request, $this->response);
    }

    public function run(){
        $this->router->resolve();
    }

}