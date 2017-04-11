<?php
namespace Xapi;
use Xapi\Request\Request;

class Xapi
{

    private $ApiPath;

    private $RequestParam;

    private $Request_Instance = null;

    private $Response_Instance = null;

    private function init(){
        $this->Request();
        $this->Response();
    }

    public function __construct($ApiPath)
    {
        $this->ApiPath = getcwd().'/'.$ApiPath;
        $this->init();
    }

    public function Request(){
        if($this->Request_Instance === null){
            return $this->Request_Instance = new Request();
        }else{
            return $this->Request_Instance;
        }
    }

    public function Response(){
        if($this->Response_Instance === null){
            return $this->Response_Instance = new Response();
        }else{
            return $this->Response_Instance;
        }
    }


    public function Run(array $RequestParam = array()){
        if(empty($RequestParam)){
            if(empty($_POST) || !is_array($_POST)){
                $_POST = array();
            }
            $this->RequestParam = $_POST;
        }else{
            $this->RequestParam = $RequestParam;
        }
        if(!isset($_GET['api'])){
            $this->RequestParam['api'] = '';
        }else{
            $this->RequestParam['api'] = $_GET['api'];
        }
        $this->init();
    }
}
function classLoader($class)
{
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = __DIR__ . DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR . $path . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
}
spl_autoload_register('classLoader');
?>
