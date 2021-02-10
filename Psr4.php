<?php
namespace Autoload;

/**
 * Autocargador de clases
 */
class Psr4
{
    /** @var array $namespace
     * Arreglo con la vinculacion de los namespace y las rutas de las clases
     */
    public $namespace = [];

    /**
     * Constructor
     *
     * Define el tipo de datos pasados
     *
     * @param mixed $namespace
     **/
    public function __construct($namespace)
    {
        try {
            if (is_array($namespace)) {
                $this->namespace($namespace);
            }
    
            if (!is_readable($namespace)) {
                throw new \Exception("Error: The file <b>{$namespace}</b> does not exist", 1);
            }

            $file_info = pathinfo($namespace);

            if ($file_info['extension'] == 'json') {
                $gestor = fopen($namespace, "r");
                $content = fread($gestor, filesize($namespace));

                $json_decode = json_decode($content, true);

                $this->namespace($json_decode['autoload']);
                fclose($gestor);
            }
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    /**
     * Namespace
     *
     * Asignacion de los valores a la variable
     *
     * @param array $namespace
     **/
    public function namespace(Array $namespace)
    {
        $this->namespace = $namespace;
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
            foreach ($this->namespace as $key => $value) {
                $len = strlen($key);
    
                $path = str_replace(['\\','/'], DS, ABS_PATH . $value . substr($class, $len) . '.php');
    
                if (is_readable($path)) {
                    $file = $path;
                break;
                }
            }
            if (!isset($file)) {
                throw new \Exception("Error: <b>{$class}</b> Not found", 1);
                
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
