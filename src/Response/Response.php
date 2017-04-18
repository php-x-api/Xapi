<?php
namespace Xapi;
class Response
{
    public $ResponseData;

    private $outputData;

    public function setMsg($msg){
        $this->outputData['msg'] = $msg;

    }

    public function setCode($code){
        $this->outputData['code'] = $code;
    }

    public function output(){
        $this->ououtputDatatput['data'] = $this->ResponseData;
        echo json_encode($this->outputData);
    }
}