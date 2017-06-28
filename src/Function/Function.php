<?php
function DI() {
    return DI::init();
}

function T($code,$replace=null){
    $languagePath = dirname(__DIR__).DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR;
    foreach(scandir(dirname(__DIR__).DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR) as $v){
        if(pathinfo($v)['extension'] == "php"){
            DI()->Language = require $languagePath.$v;
        }
    }

    var_dump(get_included_files());
    if(isset(DI()->Language[$code])){
        if(isset(DI()->Language[$code]['zh-cn'])){
            if(isset($replace)){
                if(is_array($replace)){
                    return str_replace(array('%key%','%rule%'),$replace,DI()->Language[$code]['zh-cn']);
                }else{
                    return str_replace('%search%',$replace,DI()->Language[$code]['zh-cn']);
                }
            }else{
                return DI()->Language[$code]['zh-cn'];
            }
        }else{
            return null;
        }
    }else{
        return null;
    }
}



