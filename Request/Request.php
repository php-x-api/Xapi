<?php
namespace Xapi;
class Request
{
    public $RequestParam;

    public $ApiPath;

    public function __construct($RequestParam,$ApiPath){
        $this->RequestParam = $RequestParam;
        $this->ApiPath = $ApiPath;
        $this->Validate();
    }

    private function Validate(){
        var_dump($this->RequestParam);
        list($controller,$func) = explode('.',$this->RequestParam['api']);
        unset($this->RequestParam['api']);
        require_once $this->ApiPath.'/Api/'.$controller.'.php';
        $class = new $controller;
        $Rule = $class->ApiParamRules();
        if(isset($Rule[$func]) && is_array($Rule[$func]) && count($Rule[$func]) > 0){
            foreach($Rule[$func] as $v){
                $class->$v['name'] = $this->RequestParam[$v['name']];
            }
        }

        var_dump($class);


        call_user_func(array($class,$func));

    }

    #获取API规则
    private function getApiRule()
    {


    }


}
?>