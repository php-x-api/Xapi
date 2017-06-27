<?php
function DI() {
    return DI::init();
}

function T($code,$replace=null){
    $languagePath = dirname(__DIR__).DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR;
    foreach(scandir(dirname(__DIR__).DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR) as $v){
        if(pathinfo($v)['extension'] == "php"){
            $language = require $languagePath.$v;
        }
    }
    if(isset($language[$code])){
        if(isset($language[$code]['zh-cn'])){
            if(isset($replace)){
                if(is_array($replace)){

                }else{
                    return str_replace('%search%',$replace,$language[$code]['zh-cn']);
                }
            }
        }else{
            return null;
        }
    }else{
        return null;
    }
}



