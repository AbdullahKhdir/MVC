<?php


namespace app\models;


use app\Core\Model;

class RegisterModel extends Model {

    public $firstName;
    public $lastName = "";
    public $userName = "";
    public $email = "";
    public $password = "";
    public $passwordConfirm = "";

    public function __construct(){}

    public function isRegistered(){

    }

    public function echoCmd(){
      return $this->rules();
    }

    public function rules(): array{
        return [
            "firstName" => [self::RULE_REQUIRED],
            "lastName" => [self::RULE_REQUIRED],
            "userName" => [self::RULE_REQUIRED, self::RULE_VALID], //char[0] must be @
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 15]],
            "passwordConfirm" => [self::RULE_REQUIRED, self::RULE_MATCH],
        ];
    }

    public function hasError($attribute){
        return Model::$error[$attribute] ?? false;
    }

    public function getFirstError($attribute){
        return Model::$error[$attribute][0] ?? false;
    }
}