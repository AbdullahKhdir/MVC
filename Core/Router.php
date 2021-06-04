<?php
namespace app\core;
require_once __DIR__."/Request.php";
require_once __DIR__."/Response.php";

class Router{
    protected array $routes = [];
    public namespace\Request $request;
    public namespace\Response $response;

    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback){
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback){
        $this->routes["post"][$path] = $callback;
    }

    public function resolve(){
        $path = $this->request->getPath();      //- /users
        $get  = $this->request->getMethod();    //- get
        $callBack = $this->routes[$get][$path] ?? false; // get-Request does not have the route /users set false

        if (!$callBack){
            //Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            $this->renderUnknownRoute();
        }elseif (is_string($callBack)){
            return $this->renderView($callBack);
        }
        $this->execCallBack($callBack);
    }

    public function execCallBack($callBack){
        $this->renderHeader();
        echo "<br>";
        echo call_user_func($callBack, $this->request);
        echo "<br>";
        $this->renderFooter();
    }
    public function renderView($view, $params = []){
        foreach ($params as $param => $value){
            $$param = $value;
        }
        $this->renderHeader();
        include_once Application::$ROOT_DIR."/1-views/$view.php";
        $this->renderFooter();
    }
    public function renderUnknownRoute(){
        $this->renderHeader();
        echo '<h1>NOT FOUND</h1>';
        $this->renderFooter();
    }
    public function renderHeader(){
        include_once Application::$ROOT_DIR."/1-views/layout/header.php";
    }
    public function renderFooter(){
        include_once Application::$ROOT_DIR."/1-views/layout/footer.php";
    }
}