<?php
function DI() {
    return DI::init();
}
DI()->request;

//$G_X = null;
//X();
//function X(){
//    global $G_X;
//    if($G_X == null){
//        $G_X = new G_X();
//        return $G_X;
//    }else{
//        return $G_X;
//    }
//}


class G_X {

    private $code;

    private $msg;

    public function SetCode($code){
        $this->code = $code;
    }

    public function GetCode(){
        return $this->code;
    }

    public function setMsg($msg){
        $this->msg = $msg;
    }

    public function GetMsg($msg){
        $this->msg = $msg;
    }
}

