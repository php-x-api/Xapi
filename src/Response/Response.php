<?php
namespace Xapi;
class Response
{
    public $ResponseData;
    private $output;
    public function setMsg($msg){
        $this->output['msg'] = $msg;

    }

    public function setCode($code){
        $this->output['code'] = $code;
    }

    public function output(){
        echo json_encode($this->output);
    }
}