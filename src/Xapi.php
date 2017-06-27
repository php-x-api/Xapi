<?php
namespace Xapi;
class Xapi
{

    private $ApiPath;

    private $RequestParam;

    public function __construct($ApiPath)
    {
        $this->ApiPath = getcwd().DIRECTORY_SEPARATOR.$ApiPath;
        $this->Load();
    }

    private function Load(){
        require dirname(__FILE__).DIRECTORY_SEPARATOR.'Function'.DIRECTORY_SEPARATOR.'DI.php';
        require dirname(__FILE__).DIRECTORY_SEPARATOR.'Function'.DIRECTORY_SEPARATOR.'Function.php';

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
        DI()->request->ApiPath = $this->ApiPath;
        DI()->request->Run($this->RequestParam);
    }
}

function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = basename($path);
    $file = __DIR__ . DIRECTORY_SEPARATOR  . $class . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }else{
        if( ! (strpos($class,'Formatter') === false )){
            $file = __DIR__ . DIRECTORY_SEPARATOR.substr_replace($class,'Formatter'.DIRECTORY_SEPARATOR.'Formatter',0,9).'.php';
            if (file_exists($file)) {
                require $file;
            }
        }
    }
}
spl_autoload_register('Xapi\classLoader');
?>
