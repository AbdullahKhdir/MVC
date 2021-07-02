<?php
namespace app\Core\form;
use app\Core\Model;
use app\models\queries\SignIn;
use app\models\RegisterModel;

class Field{

    public RegisterModel $model;
    public $attribute;

    public function __construct($model, $attribute){
        $this->model = $model;
        $this->attribute = $attribute;
    }


    public function __toString(): string{
            if($_SERVER["PATH_INFO"] === "/profile"){

                $userName = $_SESSION["userName"];
                $email = $_SESSION["loggedInEmail"];
                $results = (new SignIn())->fetchAccountInfos($userName, $email);

                if(!$results){
                    $results = (new SignIn())->fetchAccountInfos($userName);
                    if (!$results){
                        $results = (new SignIn())->fetchAccountInfos($email);
                    }
                }


                $params = [
                    "firstName" => $results[0]["firstname"],
                    "lastName" =>  $results[0]["lastname"],
                    "email" => $results[0]["email"],
                    "userName" => $results[0]["username"],
                    "Name" => $results[0]["firstname"]." ".$results[0]["lastname"],
                ];

                $uName = str_replace("@","",$params["userName"]);
                return sprintf('<div id="collapse%s" class="panel-collapse  %s" style="text-align: center">
                                    <div class="mb-3" style="border: solid .5px #cdd;padding: 10px;">
                                    <label class="d-flex justify-content-sm-start mb-1" for="exampleFormControlInput1" class="form-label w-50">%s</label>
                                    <div class="%s">
                                    %s
                                    <div class="d-flex justify-content-sm-start">
                                    <input type="%s"
                                           class="form-control w-50 %s"
                                           name="%s"
                                           value="%s">
                                    <div class="invalid-feedback">
                                        %s
                                    </div>
                                    </div>
                                    </div>
                                     %s',
                    $this->attribute == "firstName" ? "One" : ($this->attribute == "lastName" ? "One" : ($this->attribute == "email" ? "Two" : ($this->attribute == "userName" ? "Two" : ($this->attribute == "password" ? "Two":"")))),
                    ($this->model->hasError($this->attribute) && empty($_POST[$this->attribute])) ? "" : "collapse in",
                    strtoupper($this->attribute),
                    $this->attribute === "userName" ? 'input-group' : '',
                    $this->attribute === "userName" ? '<span class="input-group-text" id="inputGroupPrepend">@</span>' : "",
                    str_starts_with($this->attribute, "password") ? "password" : "text",
                    ($this->model->hasError($this->attribute) && empty($_POST[$this->attribute])) ? "is-invalid" : "is-valid",
                    $this->attribute,
                    $this->attribute == "password" ? "start-123" : ($this->attribute == "userName" ? $uName : $params["$this->attribute"]),
                    $this->model->getFirstError($this->attribute),
                    (new Form())::btnComponent("btn".$this->attribute));
            }else{

                return sprintf('<div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">%s</label>
                                    <div class="%s">
                                    %s
                                    <input type="%s"
                                           class="form-control %s"
                                           id="exampleFormControlInput1"
                                           placeholder="%s"
                                           name="%s"
                                           value="%s">                                    
                                    <div class="invalid-feedback">
                                        %s
                                    </div>
                                    </div>
                                    </div>',
                    strtoupper($this->attribute),
                    $this->attribute === "userName" ? 'input-group' : '',
                    $this->attribute === "userName" ? '<span class="input-group-text" id="inputGroupPrepend">@</span>' : "",
                    str_starts_with($this->attribute, "password") ? "password" : "text",
                    $this->model->hasError($this->attribute) ? "is-invalid" : ($_POST[$this->attribute] == null || empty($_POST[$this->attribute]) ? "" : "is-valid"),
                    $this->attribute === "firstName" ? "Max" : ($this->attribute === "lastName" ? "Mustermann" : ($this->attribute === "userName" ? "User123": ($this->attribute === "email" ? "name@example.com" : ($this->attribute === "password" ? "Password" : ($this->attribute === "passwordConfirm" ? "reenter your pswd" : ""))))),
                    $this->attribute,
                    $_POST["$this->attribute"],
                    $this->model->getFirstError($this->attribute)); //lbl, name, value, in-valid.
            }
    }

}


