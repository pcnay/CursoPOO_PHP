<?php
class Autoload
{
  public function __construct()
  {
    //http://php.net/manual/es/function.spl-autoload-register.php
  // Se ejecutara por cada archivo que se encuentre en la carpeta.
  // Se ejecuta una función anómima op uede ser nombre de una función.
  // Recibe como parámetro el nombre de la clase.
    spl_autoload_register(function($class_name){
      //Indicando las rutas.
      $models_path = './models/'.$class_name.'.php';
      $controllers_path = './controller/'.$class_name.'.php';
      
      // Valida si existen los archivos.
      if (file_exists($models_path))
      {        
        require_once($models_path);
       // printf ("<p>$models_path</p>");
      }

      if (file_exists($controllers_path))   
      {  
        require_once($controllers_path);
        //printf ("<p>$controllers_path</p>");
      }

    }); // Funcion($class_name)

  }
  public function __destruct()
  {
    // unset($this);
  }

}

?>