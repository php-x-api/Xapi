<?php

class Response
{
    private $ououtputDatatput;

    public $code = '200';

    public $msg = null;

    protected $headers = array();

    public $ResponseData;

    public function __construct()
    {

    }

    public function SetCode($code)
    {
        $this->code = $code;
    }

    public function SetMsg($msg)
    {
        $this->msg = $msg;
    }

    public function addHeaders($key,$value)
    {
        $this->headers[$key] = $value;
    }

    public function output()
    {
        if(empty($this->msg)){
            $this->msg = T($this->code);
        }
        $this->ououtputDatatput['code'] =  $this->code;
        $this->ououtputDatatput['msg'] = $this->msg;
        $this->ououtputDatatput['data'] = $this->ResponseData;
        echo json_encode($this->ououtputDatatput,JSON_UNESCAPED_UNICODE);
    }
}