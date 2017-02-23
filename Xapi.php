<?php
namespace Xapi;
use Xapi\Request as Request;
use Xapi\Response as Response;

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
        spl_autoload_register("Xapi\\XapiAutoLoad");
    }

    public function Run($RequestParam = null){
        if(empty($RequestParam)){
            if(empty($_POST) || !is_array($_POST)){
                $_POST = array();
            }
            $_POST['api'] = $_GET['api'];
            $this->RequestParam = $_POST;
        }else{
            $this->RequestParam = $RequestParam;
        }
        $this->Request = new Request($this->RequestParam,$this->ApiPath);
    }

    function __destruct()
    {
        spl_autoload_unregister("Xapi\\XapiAutoLoad");
    }
}

function XapiAutoLoad ($class) {
    $path = explode('\\',$class);
    require_once dirname(__FILE__).'./../'.implode('/',$path).'/'.end($path).'.php';
}


?>
