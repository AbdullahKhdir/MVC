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
                                <input type="text"
                                       class="form-control"
                                       id="exampleFormControlInput1"
                                       name="%s"
                                       value="%s"%s>
                                <div class="invalid-feedback">
                                    %s
                                </div>
                                </div>',
                                 $this->attribute,
                                         $this->attribute,
                                         $this->model->{$this->attribute},
                                         $this->model->hasError($this->attribute) ? " is-invalid" : "",
                                         $this->model->getFirstError($this->attribute)); //lbl, name, value, in-valid.
     }
}