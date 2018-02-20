<?
class Router
{
  public $route;
  public function __construct($router)
  {
    // isset = Si existe una variable o esta definida.
    if (!isset($_SESSION))
    {
      // http://php.net/manual/es/function.session-start.php    
      // Revisar el archivo de configuracion "PHP.INI", en XAMPP.
      // se agrega un arreglo como parametro en la PHP 7
      session_start([
        'use_only_cookies'=>1,
        'auto_start'=>1,
        'read_and_close'=>true // La sesion se cierre automaticamente.
      ]);
      
      $_SESSION['ok'] = false;

    }

    if ( $_SESSION['ok'])
    {
      // Toda la programación de nuestra Aplicación Web
    }
    else
    {
      // mostrar un formulario de autenticacion.
    }

  }
  public function __destruct()
  {
    unset($this);

  }

}
?>

