<?php
namespace Xapi;
use Xapi\Request as Request;
use Xapi\Response as Response;

class Xapi
{
    public $ApiPath;

    public $loader;

    private $RequestParam;

    /**
     * Xapi constructor.
     * @param $RequestParam
     */
    public function __construct($ApiPath = null)
    {
        var_dump(getcwd().'/'.$ApiPath);
        var_dump($this->ApiPath);
        spl_autoload_register("Xapi\\XapiAutoLoad");
    }

    public function request(){
        return new Request();
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
