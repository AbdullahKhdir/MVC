<?php


namespace app\Core;


abstract class Model{

    public const RULE_REQUIRED = "required";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_EMAIL = "email";
    public const RULE_MATCH = "match";
    public const RULE_VALID = "valid";
    public static array $error = [];
    public $value;

    public function __construct(){}

    public abstract function rules(): array;

    public function loadData($data){ //$req->getBody()  ["firstName"]=> string(5) "fName"
        foreach ($data as $key => $value){
            if (property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }

    public function isValid(Request $req): bool{
        foreach ($this->rules() as $attribute => $rules){
           $this->value = $this->{$attribute}; //Index of attribute "firstName", "lastName" etc.

           foreach ($rules as $rule){
               $ruleName = $rule; //String(self::RULE_REQUIRE), Array(self::RULE_MIN, "min" => 8) etc.
               if (!is_string($ruleName) && is_array($ruleName)){
                   $ruleName = $rule[0]; //self::RULE_REQUIRE "required"
               }
               if ($ruleName === self::RULE_REQUIRED && !$this->value){
                   $this->addError($attribute, self::RULE_REQUIRED);
               }elseif ($ruleName == self::RULE_EMAIL && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){
                   if (!$this->value){
                       $this->addError($attribute, self::RULE_REQUIRED);
                   }else{
                       $this->addError($attribute, self::RULE_EMAIL, $rule);
                   }
               }elseif ($ruleName == self::RULE_MIN && strlen($this->value) < $rule["min"]){
                    if (!$this->value){
                        $this->addError($attribute, self::RULE_REQUIRED, $rule);
                    }else{
                        $this->addError($attribute, self::RULE_MIN, $rule);
                    }
               }elseif ($ruleName == self::RULE_MAX && strlen($this->value) > $rule["max"]){
                   if (!$this->value) {
                       $this->addError($attribute, self::RULE_REQUIRED, $rule);
                   }else{
                     $this->addError($attribute, self::RULE_MAX, $rule);
                   }
               }elseif ($ruleName == self::RULE_VALID && (!$this->value || !str_starts_with($this->value, "@"))){
                    if (!$this->value){
                        $this->addError($attribute, self::RULE_REQUIRED, $rule);
               }else{
                        $this->addError($attribute, self::RULE_VALID, $rule);
                    }
               }elseif ($ruleName == self::RULE_MATCH &&  $this->value !== $req->getBody()["password"]){
                    $this->addError($attribute, self::RULE_MATCH, $rule);
               }
           }
        }
        return empty(self::$error); //no error return true
    }

    public function addError($attribute, $ruleName, $params = []){ //firstName, self::RULE_REQUIRED "required"

        //if(!empty(rule)  && rule === "required"){ return firstName => errTxt}else{firstName => ""}
        $getRule = $this->errMsgs()[$ruleName] ?? "";

        if($ruleName == self::RULE_MAX || $ruleName == self::RULE_MIN){
            foreach ($params as $key => $value){
                $getRule = str_replace("{{$key}}", $value, $getRule);
            }
            self::$error[$attribute][] = $getRule;
        }else{
            self::$error[$attribute][] = $getRule;
        }
    }

    public function getIndex($getAttribute){
        $index = 0;
        if (!empty(self::$error[$getAttribute][1])){ //userName, email, password, passwordConfirm
            return (int)1;
        }else{
            return (int)0;
        }
    }

    public function errMsgs(){
        return [
            self::RULE_REQUIRED => "This field is required!",
            self::RULE_EMAIL => "This field must be a valid email address!",
            self::RULE_MIN => "Min length of this field must be {min}",
            self::RULE_MAX => "Max length of this field must be {max}",
            self::RULE_MATCH => "Password confirmation does not match, please reenter your password!",
            self::RULE_VALID => "The username must begin with an '@' sign!",
        ];
    }
}