<?php

class Request
{
    private $RequestParam;

    private $Instance = null;

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
            if(file_exists($this->ApiPath.DIRECTORY_SEPARATOR.'Api'.DIRECTORY_SEPARATOR.$controller.'.php')){
                require_once $this->ApiPath.DIRECTORY_SEPARATOR.'Api'.DIRECTORY_SEPARATOR.$controller.'.php';
                if(class_exists($controller)){
                    $this->ApiInstance($controller);
                    if(method_exists($this->ApiInstance(),$func)){
                        $Rule = $this->GetApiRule($func);
                        if(count($Rule[$func]) > 0){
                            $this->ValidData($Rule[$func]);
                        }
                        DI()->response->ResponseData = call_user_func(array($this->ApiInstance(),$func));
                    }else{
                        //API方法不存在 抛出异常
                        echo "4";
                    }
                }else{
                    //API类不存在 抛出异常
                    echo "3";
                }
            }else{
                //API处理文件不存在抛出异常
                echo "2";
            }
        }else{
            //请求的API参数不能分割 抛出异常
            echo "1";
        }
    }

    private function ValidData($Rule){
        foreach($Rule as $k=>$v){
            $validSingleton = true;
            if(isset($this->RequestParam[$k])){



//                var_dump($k);
                var_dump($v);
                $this->LoadFormat($v['type']);


//                var_dump($this->RequestParam[$k]);
            }else{
                if(isset($v['required']) && $v['required'] == true){
                    $validSingleton = false;
                    break;
                }
            }
            if($validSingleton){
                $this->ApiInstance()->$k = $this->RequestParam[$k];
            }else{

            }
        }
//        var_dump($this->ApiInstance());
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




//        $VerifyState = true;
//        if(isset($Rule[$func]) && is_array($Rule[$func]) && count($Rule[$func]) > 0){
//            foreach($Rule[$func] as $k=>$v){
//                if($v['type'] == 'array'){
//
//                }else{
//                    $Verify = $this->VerifyParam($k,$this->RequestParam,$v);
//                    if($Verify['state'] == true){
//                        $class->$k = $this->RequestParam[$k];
//                    }else{
//                        $VerifyState = false;
//                        break;
//                    }
//                }
//            }
//        }
//        if($VerifyState){
//            //如果没有参数验证失败 则执行API
////            $ret = call_user_func(array($class,$func));
//        }else{
//            //有参数验证未通过 返回错误
//            return $Verify;
//        }
    }
//
//    private function VerifyParam($ParamName,$Param,$ParamRule){
//        if(isset($ParamRule['required']) && $ParamRule['required'] == true ){
//            if(isset($Param[$ParamName])){
//                return array('state'=>true);
//            }else{
//                return array('state'=>false,'err'=>[]);
//            }
//        }
//    }
//
//    function __destruct()
//    {
//
//    }

    private function LoadFormat($type){
        $typeFilePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'Format'.DIRECTORY_SEPARATOR.ucfirst($type).'.php';
        if(file_exists($typeFilePath)){
            require_once $typeFilePath;
        }else{

        }
        var_dump($typeFilePath);
    }

}
?>