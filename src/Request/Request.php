<?php

class Request
{
    private $RequestParam;

    private $Instance = null;

    private $FormatterInstance = null;

    public $ApiPath;

    public function Run(array $RequestParam = array()){
        $this->RequestParam = $RequestParam;
        $this->call();
    }

    public function ApiInstance($controller=null){
        if($this->Instance === null){
            return $this->Instance = new $controller;
        }else{
            return $this->Instance;
        }
    }

    private function call(){
        $service = explode('.',$this->RequestParam['api']);
        if(count($service) == 2){
            list($controller,$func) = $service;
            unset($this->RequestParam['api']);
            if(file_exists($this->ApiPath.'/Api/'.$controller.'.php')){
                require_once $this->ApiPath.'/Api/'.$controller.'.php';
                if(class_exists($controller)){
                    $this->ApiInstance($controller);
                    if(method_exists($this->ApiInstance(),$func)){
                        $ValidState = true;
                        $Rule = $this->GetApiRule($func);
                        if(count($Rule[$func]) > 0){
                            $valid = $this->ValidData($Rule[$func]);
                            if(!$valid['state']){
                                $ValidState = false;
//                                DI()->response->SetCode("400");
                            }
                        }
                        if($ValidState){
                            DI()->response->ResponseData = call_user_func(array($this->ApiInstance(),$func));
                        }
                    }else{
                        //API方法不存在 抛出异常
                        DI()->response->SetCode("504");
                    }
                }else{
                    //API类不存在 抛出异常
                    DI()->response->SetCode("503");
                }
            }else{
                //API处理文件不存在抛出异常
                DI()->response->SetCode("502");
            }
        }else{
            //请求的API参数不能分割 抛出异常
            DI()->response->SetCode("501");
        }
    }

    private function ValidData($Rule){
        $valid = array();
        foreach($Rule as $k=>$v){
            $validSingleton = true;
            if(isset($v['required']) && ($v['required'] == true) ){
                if(!isset($this->RequestParam[$k])){
                    $validSingleton = false;
                    DI()->response->SetCode("400");
                    DI()->response->SetMsg(T("400",$k));
                    $valid =  array('state'=>false);
                }
            }
            if($validSingleton){
                $this->GetFormatterInstance()->validation($v,$this->RequestParam[$k]);
                $valid =  array('state'=>true);
                $this->ApiInstance()->$k = $this->RequestParam[$k];
            }else{
                return $valid;
            }
        }
        return $valid;

    }

    #获取API规则
    private function GetApiRule($func)
    {
        $Rule =  $this->ApiInstance()->ApiParamRules();
        if(isset($Rule[$func]) && is_array($Rule[$func]) && !empty($Rule[$func])){
            return $Rule;
        }else{
            return array();
        }
    }

    private function GetFormatterInstance()
    {
        if($this->FormatterInstance === null){
            return $this->FormatterInstance = new Formatter();
        }else{
            return $this->FormatterInstance;
        }
    }

}
?>