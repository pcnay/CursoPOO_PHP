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
        //x Este valor es solo modificable en ".htaccess, httpd.conf,user.ini
        // No tine sentido en tiempo de ejecución decirle a PHP que autinicie sesion
        // a la vez que inicias session.
        "auto_start", // <=======
        "read_and_close" => false // La sesion se cierre automaticamente.
                                  // Si se coloca a "true" no funciona la variable Global 
                                  // $_SESSION['ok'],
      ]);

    }
    
    // Determina si existe la variable $_SESSION['ok']
    if (!isset($_SESSION['ok']))
    {      
      $_SESSION['ok'] = false;        
    }

    // Crea una session para iniciar el programa. Formulario autenticacion o Página Principal
    // isset = Si existe una variable o esta definida.
    if ($_SESSION['ok'])
    {
      // Va toda la programación de la Aplicacion Web.

      // Se decide a que ruta se ira (Es decir que opción del menu se escogio). Esta variable "r" proviene por la URL.

      $this->route = isset($_GET['r'])?$_GET['r']:'home';

      // Una vez definida la programación de entrada a las sesiones.
      // Ahora es definir toda la programación dentro de la session
      // Las opciones del menu general de la aplicación se estan cargando las vistas.
      // Es decir las rutas que manejara la aplicación.
      $controller = new ViewController();
      switch ($this->route)
      {
        case 'home':
          // Se generara un controlador de Vista para el "Home" de bienvenida en la aplicacion.
          $controller->load_view('home');      
          break;
        case 'movieseries':
          $controller->load_view('movieseries');      
          break;
        case 'usuarios':
          $controller->load_view('users');      
          break;
        case 'status':
          if (!isset($_POST['r']))
          {
            $controller->load_view('status');
          }
          // Revisando la condición para generar otra vista(pantalla) para
          // agregar un "Status". 
          else if($_POST['r'] == 'status-add' )
          {
            // Formulario para dar de alta.
            $controller->load_view("status-add");
          }
          else if($_POST['r'] == 'status-edit' )
          {
            // Formulario para editar Status
            $controller->load_view("status-edit");
          }
          else if($_POST['r'] == 'status-delete' )
          {
            // Formulario para borrar Status
            $controller->load_view("status-delete");
          }
          
          break;
        case 'salir':
          // Se accesa al controlador de Sesión para cerrarla
          $user_session = new SessionController();
          $user_session->logout();
          break;
        
        default:
          // En el caso de que el usuario no escriba correctamente las rutas en la URL.
          // (Opciones del menú).
          $controller->load_view('error404');
          break;

      }

      


    }
    else
    {
      
      // Cuando el usuario no esta autenticado, se realiza lo siguiente:
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
        // Cuando ya se definieron las variables $_POST['user'] $_POST['pass'] se generan 
        // al ejecutar "Submit" en el Formulario de Login.php 

        $user_session = new SessionController();

        // Busca al usuario en la base de datos.
        // En la clase "SessionController - Controller " se define este método "login", que a su vez se 
        // conecta al método "validate_user - " que esta definido en la clase "usersModel - Modelo " es donde
        // se conectan las capas del patron diseño MVC
        // Las variables que se agregan son las Variables globales de tipo POST que se crean en el formulario.
        // "user" y "pass".
        $sesion = $user_session->login($_POST["user"],$_POST["pass"]);
    
        if (empty($sesion))
        {
          // Como no se encontro el usuario vuelve a cargar la vista del login, pero ahora mostrara
         // un error através de la URL POST, se asigna la variable "error" el mensaje, se utiliza
         // * Location *  para recargar de nuevo la página.
         $login_form = new ViewController();
         $login_form->load_view('login');
    
         // Se redirige el flujo de la aplicación y se manda una variable por la URL.
         // * Location * permite rederigir el flujo de la aplicación  Con "/" regresaria hasta localHost, 
         // con "./" regresa al inicio de la aplicacion dondese encuentra el "index.php"
         // En el archivo "login.php" captur esta variable "error" para que las despliege en pantalla.
         header('Location: ./?error=El usuario '.$_POST["user"].' y el password proporcionado no coinciden');
          
        }
        else
        {          
          $_SESSION['ok'] = true;
          // Se rederige nuevamente al "home" de la aplicación.
          // se vuelve a ejecutar el constructor de "router.php" clase e inicia las validaciones
          // iniciales de nuevo.

          // Copiando la informacion del usuario que se obtuvo de la base de datos a variables de 
          // sesion. Ya que no afecta si se cambian las rutas.
          // Esta forma es solo que recorre el contenido del arreglo "$session" es unidimensional
          // si fuera bidimensional seria clave => valor
          // Se crean las variables de session
          // La variable "$sesion" contiene el arreglo asociativo $row['campo'] = Arreglo asociativo, se 
          // le indica el nombre del campo y nos devuelve el valor.
          foreach ($sesion as $row)
          {
            $_SESSION['user'] = $row['user'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['pass'] = $row['pass'];
            $_SESSION['role'] = $row['role'];
          }

          // Se rederige nuevamente al "home" de la aplicación.
          //header('Location: http://localhost/Curso-PHP-POO/Mexflix/index.php'); // index.php'); //  ./'); 
          //$controller = new ViewController();
          //$controller->load_view('home');      

          header('Location: ./');
        } // else if (empty(...))
    
      } // else - if (!isset($_POST["user"]) && !isset($_POST["pass"]))

    } // else - if ($_SESSION['ok'])

  } // public function __construct($route)

  public function __destruct()
  {
    // unset($this);

  }

}
?>

