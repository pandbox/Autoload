<?php
namespace Codev\Autoload;

/**
 * @subpackage Autoload PSR 4
 * 
 * Autocargador de clases
 */
class Psr4
{
    /** @var array $prefix
     * Arreglo con la vinculacion de los namespace y las rutas de las clases
     */
    public $prefix = [];

    /**
     * Constructor
     *
     * Define el tipo de datos pasados
     *
     * @param mixed $prefix
     **/
    public function __construct($prefix)
    {
        try {
            if (is_array($prefix)) {
                $this->namespace($prefix);
            }
    
            if (!is_readable($prefix)) {
                throw new \Exception("Error: The file <b>{$prefix}</b> does not exist", 1);
            }

            $file_info = pathinfo($prefix);

            switch ($file_info['extension']) {
                case 'php':
                    require_once $prefix;
                    $this->namespace($autoload);
                    break;

                case 'json':
                    $gestor = fopen($prefix, "r");
                    $content = fread($gestor, filesize($prefix));
                    $json_decode = json_decode($content, true);
                
                    $this->namespace($json_decode['autoload']);
                    fclose($gestor);
                    break;
                
                default:
                    throw new \Exception("Error: Extention {$file_info['extension']} no compatible", 1);
                    break;
            }
        } catch (\Exception $th) {
            die($th->getMessage());
        }

        return $this->autoload();
    }

    /**
     * Namespace
     *
     * Asignacion de los valores a la variable
     *
     * @param array $prefix
     **/
    public function namespace(Array $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Carga de las clases
     *
     * Ubica e importa las clases imbocadas
     *
     * @param string $class
     **/
    private function load($class)
    {
        try {
            foreach ($this->prefix as $key => $value) {
                $len = strlen($key);    
                $path = str_replace(['\\','/'], DS, ABS_PATH . $value . substr($class, $len) . '.php');
                if (is_readable($path)) {
                    $file = $path;
                break;
                }
            }
            if (!isset($file)) {
                throw new \Exception("Error: The class <b>{$class}</b> Not found", 1);
                
            }
            require_once $file;
        } catch (\Exception $th) {
            header("HTTP/1.1 404 Not Found");
            die($th->getmessage());
        }
    }

    /**
     * Autocarga de las clases
     * 
     * Mediante la funcion spl_autoload_register se llama a la funcion autoload
     **/
    public function autoload()
    {
        spl_autoload_register(array($this, 'load'));
    }
}
