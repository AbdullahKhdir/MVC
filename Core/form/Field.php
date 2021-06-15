<?php
namespace app\Core\form;
use app\Core\Model;
use app\models\RegisterModel;

class Field{

    public RegisterModel $model;
    public $attribute;

    public function __construct($model, $attribute){
        $this->model = $model;
        $this->attribute = $attribute;
    }


    public function __toString(): string{
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
                                 str_starts_with($this->attribute, "password") ? "password" : "text" ,
                                 $this->model->hasError($this->attribute) ? "is-invalid" : ($_POST[$this->attribute] == null ? "" : "is-valid"),
                                 $this->attribute === "firstName" ? "Max" : ($this->attribute === "lastName" ? "Mustermann" : ($this->attribute === "userName" ? "User123": ($this->attribute === "email" ? "name@example.com" : ($this->attribute === "password" ? "Password" : ($this->attribute === "passwordConfirm" ? "reenter your pswd" : ""))))),
                                 $this->attribute,
                                 $_POST["$this->attribute"],
                                 $this->model->getFirstError($this->attribute)); //lbl, name, value, in-valid.
            }

}


