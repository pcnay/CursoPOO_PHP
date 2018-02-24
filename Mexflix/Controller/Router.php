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
        // Este valor es solo modificable en ".htaccess, httpd.conf,user.ini
        // No tine sentido en tiempo de ejecución decirle a PHP que autinicie sesion
        // a la vez que inicias session.
        //"auto_start" => 0, <=======
        "read_and_close" => true // La sesion se cierre automaticamente.
      ]);

    }
    
    if (!isset($_SESSION['ok']))
    {
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
      // Se realiza de esta manera para validar si el usuario tiene sesion, sin utilizar
      // AJAX, es solo PHP.
      // El formulario se definio con el método "POST" y se utilizan las variables superglobal
      // POST para obtener los valores.
      if (!isset($_POST["user"]) && !isset($_POST["pass"]))
      {
        $login_form = new ViewController();
        $login_form->load_view('Login');
      }
      else
      {
        // Es aqui donde se da acceso a la aplicación.
        // Es donde se hace los enlaces con las capas del MVC. Este enruta a las demas capas
        // Llama a la Capa de Controller.
        $user_session = new SessionController();
        $sesion = $user_session->login($_POST["user"],$_POST["pass"]);
        // var_dump($sesion); Revisa el contenido del arreglo o objeto.

        if (empty($sesion))
        {
          printf("El usuario y/o el password son incorrectos");
        }
        else
        {
          printf("El usuario y el password son correctos");
        }
        
      }

    }

  }

  public function __destruct()
  {
    // unset($this);

  }

}
?>

