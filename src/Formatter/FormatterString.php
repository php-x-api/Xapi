<?php
/**
 * Created by PhpStorm.
 * User  :  liulei
 * Date  :  2017/3/15
 * Time  :  下午3:32
 * Email :  lei.liu@linkim.com.cn
 * Organization : 上海凌晋信息技术有限公司
 */
class FormatterString extends Formatter{

    private function checkout()
    {

    }

    public function maxlength($param,$length)
    {
        if(mb_strlen($param) > $length){
            return false;
        }else{
            return true;
        }
    }

    public function minlength($param,$length)
    {
        if(mb_strlen($param) < $length){
            return false;
        }else{
            return true;
        }
    }

    private function ReturnData($param){
        return $this->daddslashes($param);
    }
}