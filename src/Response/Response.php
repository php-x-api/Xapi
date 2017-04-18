<?php
namespace Xapi;
class Response
{
    public $ResponseData;

    private $ououtputDatatput;

    public function setMsg($msg){
        $this->ououtputDatatput['msg'] = $msg;

    }

    public function setCode($code){
        $this->ououtputDatatput['code'] = $code;
    }

    public function output(){
        $this->ououtputDatatput['data'] = $this->ResponseData;
        echo json_encode($this->outputData);
    }
}