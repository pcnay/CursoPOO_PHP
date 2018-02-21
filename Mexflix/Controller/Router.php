 <?php
class Router
{
  public $route; // Recibe un parámetro la clase
  public function __construct($route)
  {
    // Determina si existe una sesion de PHP.
    if (!isset($_SESSION))
    {
      // http://php.net/manual/es/function.session-start.php    
      // Revisar el archivo de configuracion "PHP.INI", en XAMPP.
      // se agrega un arreglo como parametro en la PHP 7, modifican en PHP.ini
      // Valores minímos para que opera la sesión en PHP 7
      session_start([
        "use_only_cookies" => 1,
        "auto_start" => 1,
        "read_and_close" => true // La sesion se cierre automaticamente.
      ]);

      // Una vez creada la sesion, se define una variable de sesion.
      $_SESSION['ok'] = false;
    }
    
    // Crea una session para iniciar el programa. Formulario autenticacion o Página Principal
    // isset = Si existe una variable o esta definida.
    if ($_SESSION['ok'])
    {
        // Va toda la programación de la Aplicacion Web.
      
    }
    else
    {
      // mostrar un formulario de autenticacion.
    }

  }

  public function __destruct()
  {
    // unset($this);

  }

}
?>

