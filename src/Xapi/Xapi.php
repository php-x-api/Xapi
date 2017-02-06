<?php
namespace Xapi;
class Xapi extends Api
{
    #设置请求参数
    public function setRequestData($param)
    {
        $this->param = $param;
    }



    #初始化 启动API
    public function init()
    {
        $rs = new Request($this->param);
    }
}
?>
