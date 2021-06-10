<?php


namespace app\models;


use app\Core\Model;

class RegisterModel extends Model {

    public $firstName = "";
    public $lastName = "";
    public $userName = "";
    public $email = "";
    public $password = "";
    public $passwordConfirm = "";


    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPasswordConfirm(): string
    {
        return $this->passwordConfirm;
    }

    /**
     * @param string $passwordConfirm
     */
    public function setPasswordConfirm(string $passwordConfirm): void
    {
        $this->passwordConfirm = $passwordConfirm;
    }

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

    public function getError(): bool{
        if (!empty(Model::$error)){
            return true;
        }else{
            return false;
        }
    }
}