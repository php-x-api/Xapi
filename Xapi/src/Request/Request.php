<?php
namespace Xapi\Request;
class Request
{
    public $sss;
//    public $RequestParam;
//
//    public $ApiPath;
//
//    public function ValiApi($RequestParam,$ApiPath){
//        $this->RequestParam = $RequestParam;
//        $this->ApiPath = $ApiPath;
//        $service = explode('.',$this->RequestParam['api']);
//        if(count($service) == 2){
//            list($controller,$func) = $service;
//            unset($this->RequestParam['api']);
//            if(file_exists($this->ApiPath.'/Api/'.$controller.'.php')){
//                require_once $this->ApiPath.'/Api/'.$controller.'.php';
//                if(class_exists($controller)){
//                    $class = new $controller;
//                    if(method_exists($class,$func)){
//                        $this->getApiRule($class,$func);
//                    }else{
//                        //API方法不存在 抛出异常
//                        echo "4";
//                    }
//                }else{
//                    //API类不存在 抛出异常
//                    echo "3";
//                }
//            }else{
//                //API处理文件不存在抛出异常
//                echo "2";
//            }
//        }else{
//            //请求的API参数不能分割 抛出异常
//            echo "1";
//        }
//    }
//
//    private function Validate(){
//
//    }
//
//    #获取API规则
//    private function getApiRule($class,$func)
//    {
//        $Rule = $class->ApiParamRules();
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
//            $ret = call_user_func(array($class,$func));
//        }else{
//            //有参数验证未通过 返回错误
//            return $Verify;
//        }
//    }
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

//    public function
}
?>