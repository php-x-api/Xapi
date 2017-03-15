<?php
namespace Xapi;
use Xapi\Request as Request;
use Xapi\Response as Response;
use Xapi\Api;

class Xapi
{
    private $ApiPath;

    public $Loader;

    private $RequestParam;

    public $Request;



    /**
     * Xapi constructor.
     * @param $RequestParam
     */
    function __construct($ApiPath)
    {
        $this->ApiPath = getcwd().'/'.$ApiPath;
        require_once dirname(__FILE__).'/Request/Request.php';
        require_once dirname(__FILE__).'/Api/Api.php';
    }

    public function Run($RequestParam = null){
        if(isset($_GET['api'])){
            if(empty($RequestParam)){
                if(empty($_POST) || !is_array($_POST)){
                    $_POST = array();
                }
                $this->RequestParam = $_POST;
            }else{
                $this->RequestParam = $RequestParam;
            }
            $this->RequestParam['api'] = $_GET['api'];
            $this->Request = new Request($this->RequestParam,$this->ApiPath);
        }else{
            //没有定义请求的API 抛出异常
        }
    }
}



?>
