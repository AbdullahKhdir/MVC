<?php
namespace app\controllers;
require_once __DIR__."/../Core/Request.php";

use app\core\Application;
use app\Core\Controller;
use app\core\Request;
    //-----------------------------------------------

class SiteController extends Controller{

    public function __construct(){}

    public function handleHomePostedData(Request $request = null){
        $params = [
            "name" => "User"
        ];
        /*if ($request){
            $body = $request->getBody();
        }*/
        return $this->render("home", $params);
    }

    public function handleHome(){
        return $this->render("home");
    }

    public function contact(){
        return $this->render("contact");
    }

}