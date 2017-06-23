<?php
function DI() {
    return DI::init();
}

function T($code){
    $languagePath = dirname(__DIR__).DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR;
    foreach(scandir(dirname(__DIR__).DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR) as $v){
        if(pathinfo($v)['extension'] == "php"){
            $language = require $languagePath.$v;

        }
    }
    if(isset($language[$code])){
        if(isset($language[$code]['zh-cn'])){
            return $language[$code]['zh-cn'];
        }else{
            return 'zh-cn错误信息未设置';
        }
    }else{
        return '错误信息未设置';
    }
}



