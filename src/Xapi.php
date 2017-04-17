<?php
namespace Xapi;
class Xapi
{

    private $ApiPath;

    private $RequestParam;

    private $Request_Instance = null;

    private $Response_Instance = null;


    public function __construct($ApiPath)
    {
        $this->ApiPath = getcwd().'/'.$ApiPath;
    }

    public function Request(){
        if($this->Request_Instance === null){
            return $this->Request_Instance = new Request($this->RequestParam,$this->ApiPath);
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
        $this->Response()->ResponseData  = $this->Request()->ReturnData;
    }
}

function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = basename($path);
    $file = __DIR__ . DIRECTORY_SEPARATOR  . $class . DIRECTORY_SEPARATOR . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('Xapi\classLoader');
?>
