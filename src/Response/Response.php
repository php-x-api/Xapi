<?php
namespace Xapi;
class Response
{
    public $ResponseData;
    static public function setMsg(){

    }

    public function setCode(){

    }

    public function output(){
        echo json_encode($this->ResponseData);
    }
}