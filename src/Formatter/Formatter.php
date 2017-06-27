<?php
/**
 * Created by PhpStorm.
 * User  :  liulei
 * Date  :  2017/6/25
 * Time  :  16:08
 * Email :  lei.liu@linkim.com.cn
 * Organization : 上海凌晋信息技术有限公司
 */
class Formatter
{
    private $Instance = array();

    public function validation($rules,$param)
    {
        $class = $this->FormatterInstance($rules['type']);
        unset($rules['type'],$rules['required']);
        $support = get_class_methods($class);
        $diff = array_diff(array_keys($rules),$support);
        if(empty($diff)){
            $state = true;
            foreach(array_keys($rules) as $v){
                $Valid = call_user_func_array(array($class,$v),array($param,$rules[$v]));
                if(!$Valid){
                    $state = false;
                    break;
                }
            }
            if($state){
                return array('state'=>true);
            }else{
                var_dump('验证未通过');
            }
        }else{
            //使用了不支持的校验方式
            var_dump('不存在的验证规则');
        }
    }

    private function FormatterInstance($type){
        if(!isset($this->Instance[$type])){
            $type = 'Formatter'.ucfirst($type);
            return $this->Instance[$type] = new $type;
        }else{
            return $this->Instance[$type];
        }
    }

    public function key_compare_func($key1, $key2)
    {
        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    }

    public function daddslashes($string) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = daddslashes($val, $force);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }


}