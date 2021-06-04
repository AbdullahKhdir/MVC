<?php


namespace app\Core;


class Response
{
    public function __construct(){}

    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

}